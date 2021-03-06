<?php
namespace library\log\writer;
use library\log\writer;
class file implements writer
{
	private $handle = null;
	private $mode   = null;

	public function __construct($file=null, $mode=null)
	{
		if(is_file($file) and is_writable($file)) {
			$this->handle = fopen($file, ($mode ? $mode : 'a'));
		} elseif(is_dir(dirname($file)) and is_writable(dirname($file))) {
			$this->handle = fopen($file, ($mode ? $mode : 'w'));
		} else {
			throw new \InvalidArgumentException('The file is not writable');
		}
	}

	public function write($log)
	{
		fwrite($this->handle, $log."\n");
	}

	public function __destruct()
	{
		fclose($this->handle);
	}
}
