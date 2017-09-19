<?php

class MainFactory
{
	private static $CLASSES = [];

	public static function SetClass($className, $namespace, $dependencies = [], $isSingleton = false)
	{
		self::$CLASSES[$className] =
		[
			'Namespace' => $namespace,
			'Dependencies' => $dependencies,
			'IsSingleton' => $isSingleton,
			'Object' => null
		];
	}

	public static function BUILD($class)
	{
		$instance = null;

		if(isset(self::$CLASSES[$class]))
		{
			$instance = self::$CLASSES[$class]['Object'];

			if(is_null($instance))
			{
				$namespace = self::$CLASSES[$class]['Namespace'];
				$dependencies = self::$CLASSES[$class]['Dependencies'];

				$args = [];

				foreach ($dependencies as $dependence)
				{
					$args[] = self::BUILD($dependence);
				}

				try
				{
					$reflector = new \ReflectionClass($namespace);

					$instance = $reflector->newInstanceArgs($args);

					if(self::$CLASSES[$class]['IsSingleton'])
					{
						self::$CLASSES[$class]['Object'] = $instance;
					}
				} catch (\ReflectionException $e)
				{
					$instance = null;
				}
			}
		}

		return $instance;
	}
}
?>