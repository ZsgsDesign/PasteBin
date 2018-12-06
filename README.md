# PasteBin
Yet another PasteBin, all right?

## Install
Create a new php file named CONFIG.php in /protected/model/ and insert:
```
<?php

class CONFIG {
	
	/**
	 * CONFIG
	 *
	 * @author John Zhang
	 * @param string $KEY
	 */

	public static function GET($KEY)
	{
		$config=array(
			"PB_DEBUG_MYSQL_HOST"=>"",
			"PB_DEBUG_MYSQL_PORT"=>"",
			"PB_DEBUG_MYSQL_USER"=>"",
			"PB_DEBUG_MYSQL_DATABASE"=>"",
			"PB_DEBUG_MYSQL_PASSWORD"=>"",

			"PB_MYSQL_HOST"=>"",
			"PB_MYSQL_PORT"=>"",
			"PB_MYSQL_USER"=>"",
			"PB_MYSQL_DATABASE"=>"",
			"PB_MYSQL_PASSWORD"=>"",

			"PB_CDN"=>"https://static.1cf.co",
			"PB_DOMAIN"=>"",
			"PB_SALT"=>""
		);
		return $config[$KEY];
	}
	

}

```

The type in the configuration of your mysql server to this file.

**NOTICE :** Normally, you only need to set fields with DEBUG.