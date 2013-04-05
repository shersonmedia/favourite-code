<?php

// This is REALLY easy error reporting for PHP. Save this file in your project
// and use 'include_once(PATH_TO_FILE);' to bring it in AS EARLY IN YOUR SETUP
// AS POSSIBLE. It will give you nicely formatted errors in your browser when
// they occur AFTER you've included this file.

// THERE IS LITERALLY NOTHING YOU NEED TO DO AFTER INCLUDING THIS FILE. IT
// HANDLES THE REST FOR YOU. :)

class Error {
	public static function exception($exception, $trace = true)
	{
		ob_get_level() and ob_end_clean();
		$message = $exception->getMessage();
		$file = $exception->getFile();

		$response_body = "<html><h2>Unhandled Exception</h2>
			<h3>Message:</h3>
			<pre>".$message."</pre>
			<h3>Location:</h3>
			<pre>".$file." on line ".$exception->getLine()."</pre>";

		if ($trace)
		{
			$response_body .= "
			  <h3>Stack Trace:</h3>
			  <pre>".$exception->getTraceAsString()."</pre></html>";
		}
		echo $response_body;
		exit(1);
	}

	public static function native($code, $error, $file, $line)
	{
		if (error_reporting() === 0) return;
		$exception = new \ErrorException($error, $code, 0, $file, $line);
		static::exception($exception);
	}

	public static function shutdown()
	{
		$error = error_get_last();
		if ( ! is_null($error))
		{
			extract($error, EXTR_SKIP);
			static::exception(new \ErrorException($message, $type, 0, $file, $line), false);
		}
	}
}

set_exception_handler(function($e)
{
	Error::exception($e);
});
set_error_handler(function($code, $error, $file, $line)
{
	Error::native($code, $error, $file, $line);
});
register_shutdown_function(function()
{
	Error::shutdown();
});
error_reporting(-1);