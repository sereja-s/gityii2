<?php


use \kartik\datecontrol\Module;

$params = array_merge(
	require __DIR__ . '/../../common/config/params.php',
	require __DIR__ . '/../../common/config/params-local.php',
	require __DIR__ . '/params.php',
	require __DIR__ . '/params-local.php'
);

return [
	'id' => 'app-backend',
	'basePath' => dirname(__DIR__),
	'controllerNamespace' => 'backend\controllers',
	'bootstrap' => ['log', 'gii', 'debug'],
	'language' => 'ru',
	'modules' => [
		'gii' => [
			'class' => 'yii\gii\Module',
			'generators' => [ // здесь
				'crud' => [ // название генератора
					'class' => 'yii\gii\generators\crud\Generator', // класс генератора
					'templates' => [ // настройки сторонних шаблонов
						'myGii' => '@common/generators/crud/default', // имя_шаблона => путь_к_шаблону
					]
				]
			],
		],
		'debug' => [
			'class' => 'yii\debug\Module',
		],
		'datecontrol' =>  [
			'class' => 'kartik\datecontrol\Module',

			// format settings for displaying each date attribute (ICU format example)
			'displaySettings' => [
				Module::FORMAT_DATE => 'php:d-M-Y',
				Module::FORMAT_TIME => 'php:H:i',
				Module::FORMAT_DATETIME => 'php:d-M-Y H:i',
			],

			// format settings for saving each date attribute (PHP format example)
			'saveSettings' => [
				Module::FORMAT_DATE => 'yyyy-M-dd',
				Module::FORMAT_TIME => 'H:i:s',
				Module::FORMAT_DATETIME => 'yyyy-M-dd H:i:s',
			],

			// set your display timezone
			'displayTimezone' => 'UTC',

			// set your timezone for date saved to db
			'saveTimezone' => 'UTC',

			// automatically use kartik\widgets for each of the above formats
			'autoWidget' => true,
		]
	],
	'components' => [

		'request' => [
			'csrfParam' => '_csrf-backend',
		],
		'user' => [
			'identityClass' => 'common\models\User',
			'enableAutoLogin' => true,
			'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
		],
		'session' => [
			// this is the name of the session cookie used for login on the backend
			'name' => 'advanced-backend',
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
			],
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],

		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules' => [],
		],
		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'decimalSeparator' => ',',
			'thousandSeparator' => ' ',
			'currencyCode' => 'EUR',
			'dateFormat' => 'php:d-M-Y',
			'datetimeFormat' => 'php:d-M-Y H:i',
		],
	],
	'params' => $params,
];
