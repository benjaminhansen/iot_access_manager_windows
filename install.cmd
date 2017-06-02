@echo off

mklink /D %~dp0\vendor %~dp0\app\laravel\iotmgmt\vendor



echo @echo off >> %~dp0\run.cmd

echo app\php\windows\php.exe app\laravel\iotmgmt\artisan iot:register >> %~dp0\run.cmd

echo pause >> %~dp0\run.cmd