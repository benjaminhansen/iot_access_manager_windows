@echo off

mklink /D %~dp0\vendor %~dp0\assets\laravel\iotmgmt\vendor



echo @echo off >> %~dp0\run.cmd

echo assets\php\windows\php.exe assets\laravel\iotmgmt\artisan iot:register >> %~dp0\run.cmd

echo pause >> %~dp0\run.cmd