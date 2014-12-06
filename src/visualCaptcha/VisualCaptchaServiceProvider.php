<?php namespace visualCaptcha;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Factory;

/**
 * Service provider for the Visual Captcha
 * 
 * @author     Nurhidayat Fembrianto
 * @link       https://github.com/fembri

 */

class VisualCaptchaServiceProvider extends ServiceProvider
{

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('emotionloop/visualcaptcha');
		
		$this->addValidator();
		$this->addFormMacro();
	}
		
	/**
	 * Extends Validator to include a recaptcha type
	 */
	public function addValidator()
	{
		$validator = $this->app['Validator'];
		
		$validator::extend('visual_captcha', function($attribute, $value, $parameters)
		{
			$type = $parameters[0];
			if ($type == 'image')
				return app('visualcaptcha')->validateImage($value);
			elseif ($type == 'audio')
				return app('visualcaptcha')->validateAudio($value);
							
			return false;
		});
	}
	
	/**
	 * Extends Form to include a recaptcha macro
	 */
	public function addFormMacro()
	{
		app('form')->macro('visual_captcha', function($options = array())
		{
			$captchaOptions = array();
			$captchaOptions['imgPath'] = asset('/assets/images/visualcaptcha')."/";
			$captchaOptions['captcha']['url'] = url('vcaptcha');
			$captchaOptions['captcha']['numberOfImages'] = 3;
			$captchaOptions['captcha']['namespaceFieldName'] = 'visualcaptcha';
			
			$data = array(
				'options'		=> $options,
				'captcha'		=> $captchaOptions,
			);
			
			if (is_dir(app_path() . "/views/packages/fembri/visualcaptcha"))
				app('view')->addNamespace('visualcaptcha', 'app/views/packages/fembri/visualcaptcha');
			else
				app('view')->addNamespace('visualcaptcha', 'vendor/fembri/visualcaptcha/src/views');
			
			return app('view')->make('visualcaptcha::visualcaptcha', $data);
		});
	}
	

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		app('app')->bind('visualcaptcha', function(){
			return new VisualCaptcha(new Session);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		
	}

}
