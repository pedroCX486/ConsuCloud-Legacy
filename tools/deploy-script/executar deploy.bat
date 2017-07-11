@echo off
@cls

@echo OrangeMayhem Softworks (C) 2017
@echo.
@echo.

@echo Script de deploy: ConsuCloud - Projeto RAPADURA
@echo.
@pause
@echo.

@echo Executando deploy do ConsuCloud...
timeout 2 > NUL
@echo.

for /f "tokens=1-6 delims=/ " %%i in ("%date%") do (
     set day=%%i
     set month=%%j
     set year=%%k
)
set datestr=%day%%month%%year%

@echo Versao: DEPLOY-%datestr%-CONSUCLOUD-PROD
@echo.

xcopy  %userprofile%\Source\Repos\ConsuCloud  %userprofile%\Desktop\DEPLOY-%datestr%-CONSUCLOUD-PROD\ /EXCLUDE:exclusions.txt /E
@echo DEPLOY-%datestr%-CONSUCLOUD-PROD> %userprofile%\Desktop\DEPLOY-%datestr%-CONSUCLOUD-PROD\version.txt
@echo.

@echo Comprimindo...
@timeout 2 > NUL
@echo.
@7z a -tzip  %userprofile%\Desktop\deploy.zip  %userprofile%\Desktop\DEPLOY-%datestr%-CONSUCLOUD-PROD\*
@echo.

@echo Executando limpeza...
@echo.
@rmdir /S /Q  %userprofile%\Desktop\DEPLOY-%datestr%-CONSUCLOUD-PROD\
@echo.

@echo Deploy executado em:  %userprofile%\Desktop\DEPLOY-%datestr%-CONSUCLOUD-PROD.zip
@echo.

pause