<?php

class deamon 
{
	private $jobs = [];

	public function _deamon()
	{
		error_reporting(E_ALL);
		if( !extension_loaded('pcntl') || !extension_loaded('posix') || PHP_SAPI != 'cli' ) exit('run in cli!');

		$pid = pcntl_fork();
		if($pid == -1) {
			exit('fork fail');
		} else if($pid > 0) {
			exit('parent gone'.PHP_EOL);
		}

		if( posix_setsid() === -1) exit('setsid fail');

		chdir('/tmp/deamon/');
		umask(0);
		// fclose(STDIN);fclose(STDERR);fclose(STDOUT);
		echo 'child executing, pid is : '.posix_getpid().PHP_EOL;

		if(!empty($this->jobs)) {
			foreach($this->jobs as $job ) {
				call_user_func_array($job['func_name'], $job['func_args']);
			}
		}
		
	}

	public function addJobs(array $job)
	{
		$this->jobs[] = $job;
	}

	public function run($argv)
	{
		if(!$argv || !count($argv)) exit('call fail');
		switch($argv[1]) {
			case 'start':
			$this->_deamon();break;

			case 'stop':
			posix_kill(posix_getpid(), 15);break;

			case 'status':
			if(posix_getpid() > 0) exit(posix_getpid().' : running');
			else exit('not running');
			break;
		}
	}
}

function test($param)
{
	while(1) {
		file_put_contents('/tmp/deamon/log.txt', 'HeLlO WoRlD'.$param.PHP_EOL, FILE_APPEND) ;
		sleep(5);
	}
}

$deamon = new deamon();
$deamon->addJobs(['func_name' => 'test', 'func_args' => ['laokiea']]);
$deamon->run($argv);
