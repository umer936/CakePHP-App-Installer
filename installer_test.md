`git clone http://sodasdev.space.swri.edu:3000/SODAS/SDDASWeb.git installer_test`

`cd installer_test`

`vim composer.json`
```json
,
        {
            "type": "vcs",
            "url": "https://github.com/umer936/CakePHP-App-Installer.git"
        }

```

`composer install`
`Y`

`composer require cakephp-app-installer/installer:dev-SwRI_SOC`

Make `installer_test` db on phpmyadmin

`bin/cake plugin load CakePHPAppInstaller`

Go to https://porky.space.swri.edu/installer_test/installer

`sudo chmod -R 777 config vendor`

continue with browser pages

`mv config/site_style_vars.css plugins/WhiteLabel/webroot/css/`

`bin/cake migrations migrate`
`bin/cake migrations seed`
`bin/cake asset_compress build`

[Go to Website] `https://porky.space.swri.edu/installer_test/`
