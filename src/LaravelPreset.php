<?php

namespace Acme\LaravelPreset;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\Presets\Preset;
use Illuminate\Support\Arr;

class AbdiPreset extends Preset
{
	public static function install()
	{
		static::ensureCssDirectoryExists();
		static::cleanSassDirectory();
		static::updatePackages();
		static::updateCss();
		static::updateWebpack();
		static::updateBootstrapJs();
	}

	public static function cleanSassDirectory()
	{
		\File::cleanDirectory(resource_path('assets/sass'));
	}

	protected static function updatePackageArray($packages)
	{
		return ['tailwindcss' => '^0.5.3'] + Arr::except($packages, [
            'babel-preset-react',
            'jquery',
            'bootstrap',
            'popper.js',
            'lodash',
            'react',
            'react-dom',
        ]);
	}

	public static function updateWebpack()
	{
		copy(__DIR__ . "/stubs/webpack.mix.js", base_path("webpack.mix.js"));
	}

	public static function updateCss()
	{
		copy(__DIR__ . "/stubs/app.css", resource_path("assets/css/app.css"));
	}

	public static function ensureCssDirectoryExists()
	{
		$fileSystem = new Filesystem;

		if (! $fileSystem->isDirectory($directory = resource_path("assets/css"))) {
			$fileSystem->makeDirectory($directory, 0755, true);
		}
	}

	public static function updateBootstrapJs()
	{
		copy(__DIR__ . "/stubs/bootstrap.js", resource_path("assets/js/bootstrap.js"));
	}
}