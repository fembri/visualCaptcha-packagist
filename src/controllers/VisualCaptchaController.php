<?php
class VisualCaptchaController extends BaseController {
 
	public function start($sum)
	{
		VisualCaptcha::generate($sum);
		echo json_encode(VisualCaptcha::getFrontendData());
	}
	
	public function audio()
	{
		return Response::download(VisualCaptcha::streamAudio( '', 'mp3'));
	}
	
	public function image($index)
	{
		return Response::download(VisualCaptcha::streamImage( '', $index, FALSE ));
	}
}
?>