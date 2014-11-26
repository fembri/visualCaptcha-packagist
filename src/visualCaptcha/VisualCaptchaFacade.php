<?php namespace visualCaptcha;
use Illuminate\Support\Facades\Facade;
/**
 * @see \Illuminate\View\Environment
 */
class VisualCaptchaFacade extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'visualcaptcha'; }

}
