d:
cd \wamp21e\www\sitejoomla_baseannuairethematique\components\com_sobipro
pause

rmdir etc
MKLINK /D etc D:\wamp21e\www\sitejoomla_baseannuaire_git\components\com_sobipro\etc
pause

rmdir lib
MKLINK /D lib D:\wamp21e\www\sitejoomla_baseannuaire_git\components\com_sobipro\lib
pause

rmdir opt
MKLINK /D opt D:\wamp21e\www\sitejoomla_baseannuaire_git\components\com_sobipro\opt
pause

rmdir var
MKLINK /D var D:\wamp21e\www\sitejoomla_baseannuaire_git\components\com_sobipro\var
pause

rmdir views
MKLINK /D views D:\wamp21e\www\sitejoomla_baseannuaire_git\components\com_sobipro\views
pause

rmdir tmp
MKLINK /D tmp D:\wamp21e\www\sitejoomla_baseannuaire_git\components\com_sobipro\tmp
pause

rmdir usr
MKLINK /D usr D:\wamp21e\www\sitejoomla_baseannuairethematique_git\components\com_sobipro\usr
pause


cd \wamp21e\www\sitejoomla_baseannuairethematique\modules
rmdir mod_jmaps
MKLINK /D mod_jmaps D:\wamp21e\www\sitejoomla_baseannuaire_git\modules\mod_jmaps
pause

cd \wamp21e\www\sitejoomla_baseannuairethematique\plugins\system
rmdir plugin_googlemap2
MKLINK /D plugin_googlemap2 D:\wamp21e\www\sitejoomla_baseannuaire_git\plugins\system\plugin_googlemap2
pause

cd \wamp21e\www\sitejoomla_baseannuairethematique
rmdir scripts
MKLINK /D scripts D:\wamp21e\www\sitejoomla_baseannuaire_git\scripts
pause

cd \wamp21e\www\sitejoomla_baseannuairethematique\templates
rmdir baseannuairethematique
MKLINK /D baseannuairethematique D:\wamp21e\www\sitejoomla_baseannuairethematique_git\templates\baseannuairethematique
pause