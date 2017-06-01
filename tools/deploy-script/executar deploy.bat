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
timeout 3 > NUL
@echo.

for /f "tokens=1-6 delims=/ " %%i in ("%date%") do (
     set day=%%i
     set month=%%j
     set year=%%k
)
set datestr=%day%%month%%year%

@echo Versao: DEPLOY-%datestr%-CONSUCLOUD-PROD
@echo.

xcopy C:\Users\Pedro\Source\Repos\ConsuCloud C:\Users\Pedro\Desktop\DEPLOY-%datestr%-CONSUCLOUD-PROD\ /EXCLUDE:exclusions.txt /E
@echo.
@echo Comprimindo...
@timeout 2 > NUL
@echo.
@7z a -tzip C:\Users\Pedro\Desktop\DEPLOY-%datestr%-CONSUCLOUD-PROD.zip C:\Users\Pedro\Desktop\DEPLOY-%datestr%-CONSUCLOUD-PROD\*
@echo.
@echo Executando limpeza...
@echo.
@rmdir /S /Q C:\Users\Pedro\Desktop\DEPLOY-%datestr%-CONSUCLOUD-PROD\
@echo.
@echo Deploy executado em: C:\Users\Pedro\Desktop\DEPLOY-%datestr%-CONSUCLOUD-PROD.zip
@echo.

pause