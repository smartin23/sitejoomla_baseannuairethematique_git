d:
cd \wamp21e\www\sitejoomla_baseannuairethematique\components\com_sobipro
MKLINK /D etc D:\wamp21e\www\sitejoomla_baseannuaire_git\components\com_sobipro\etc
pause
MKLINK /D lib D:\wamp21e\www\sitejoomla_baseannuaire_git\components\com_sobipro\lib
pause
MKLINK /D opt D:\wamp21e\www\sitejoomla_baseannuaire_git\components\com_sobipro\opt
pause
MKLINK /D var D:\wamp21e\www\sitejoomla_baseannuaire_git\components\com_sobipro\var
pause
MKLINK /D views D:\wamp21e\www\sitejoomla_baseannuaire_git\components\com_sobipro\views
pause
MKLINK /D tmp D:\wamp21e\www\sitejoomla_baseannuaire_git\components\com_sobipro\tmp
pause
MKLINK /D usr D:\wamp21e\www\sitejoomla_baseannuairethematique_git\components\com_sobipro\usr
pause


cd \wamp21e\www\sitejoomla_baseannuairethematique\modules
rmdir mod_jmaps
MKLINK /D mod_jmaps D:\wamp21e\www\sitejoomla_baseannuaire_git\modules\mod_jmaps
pause
cd \wamp21e\www\sitejoomla_baseannuairethematique
rmdir scripts
MKLINK /D scripts D:\wamp21e\www\sitejoomla_baseannuaire_git\scripts
pause
cd \wamp21e\www\sitejoomla_baseannuairethematique\templates
rmdir baseannuairethematique
MKLINK /D baseannuairethematique D:\wamp21e\www\sitejoomla_baseannuairethematique_git\templates\baseannuairethematique
pause
