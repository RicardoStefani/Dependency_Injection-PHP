<?php

class MainFactory 
{
	private $classes = [];

	public function __construct()
	{}

	public function RegisterFactory($factory)
	{
		$factory->GetClass($this);	
	}

	public function SetClass($className, $namespace, $dependencies = [], $isSingleton = false)
	{
		$this->classes[$className] = 
		[
			'Namespace' => $namespace,
			'Dependencies' => $dependencies,
			'IsSingleton' => $isSingleton,
			'Object' => null
		];
	}

	public function build($class)
	{
		$instance = null;

		if(isset($this->classes[$class]))
		{
			$instance = $this->classes[$class]['Object'];

			if(is_null($instance))
			{
				$namespace = $this->classes[$class]['Namespace'];
				$dependencies = $this->classes[$class]['Dependencies'];

				$args = [];

				foreach ($dependencies as $dependence)
				{
					$args[] = $this->build($dependence);
				}

				$reflector = new \ReflectionClass($namespace);

				$instance = $reflector->newInstanceArgs($args);

				if($this->classes[$class]['IsSingleton'])
				{
					$this->classes[$class]['Object'] = $instance;
				}
			}
		}

		return $instance;
	}
}
?>