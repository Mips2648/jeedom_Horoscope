<?php
if (!isConnect('admin')) {
	throw new Exception('{{401 - Accès non autorisé}}');
}
$plugin = plugin::byId('Horoscope');
sendVarToJS('eqType', 'Horoscope');
$eqLogics = eqLogic::byType('Horoscope');
?>

<div class="row row-overflow">
    <div class="col-lg-2 col-md-3 col-sm-4">
        <div class="bs-sidebar">
            <ul id="ul_eqLogic" class="nav nav-list bs-sidenav">
                <a class="btn btn-default eqLogicAction" style="width : 100%;margin-top : 5px;margin-bottom: 5px;" data-action="add"><i class="fa fa-plus-circle"></i> {{Ajouter un template}}</a>
                <li class="filter" style="margin-bottom: 5px;"><input class="filter form-control input-sm" placeholder="{{Rechercher}}" style="width: 100%"/></li>
                <?php
foreach ($eqLogics as $eqLogic) {
	echo '<li class="cursor li_eqLogic" data-eqLogic_id="' . $eqLogic->getId() . '"><a>' . $eqLogic->getHumanName(true) . '</a></li>';
}
?>
           </ul>
       </div>
   </div>

   <div class="col-lg-10 col-md-9 col-sm-8 eqLogicThumbnailDisplay" style="border-left: solid 1px #EEE; padding-left: 25px;">
    <legend>{{Mes Horoscopes}}
    </legend>
	<legend><i class="fa fa-cog"></i>  {{Gestion}}</legend>
    <div class="eqLogicThumbnailContainer">
      <div class="cursor eqLogicAction" data-action="add" style="background-color : #ffffff; height : 200px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;" >
         <center>
            <i class="fa fa-plus-circle" style="font-size : 7em;color:#94ca02;"></i>
        </center>
        <span style="font-size : 1.1em;position:relative; top : 23px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;color:#94ca02"><center>{{Ajouter}}</center></span>
    </div>

	      <div class="cursor eqLogicAction" data-action="gotoPluginConf" style="background-color : #ffffff; height : 120px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;">
                <center>
                    <i class="fa fa-wrench" style="font-size : 6em;color:#767676;"></i>
                </center>
                <span style="font-size : 1.1em;position:relative; top : 15px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;color:#767676"><center>{{Configuration}}</center></span>
            </div>
		</div>


		<legend><i class="fa fa-table"></i> {{Mes Horoscopes}}</legend>
<div class="eqLogicThumbnailContainer">	
    <?php
foreach ($eqLogics as $eqLogic) {
	echo '<div class="eqLogicDisplayCard cursor" data-eqLogic_id="' . $eqLogic->getId() . '" style="background-color : #ffffff; height : 200px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;" >';
	echo "<center>";
	//echo '<img src="plugins/Horoscope/doc/images/Belier.png" height="105" width="95" />';
	$Signe2=$eqLogic->getConfiguration('Signe');
	echo '<img src="plugins/Horoscope/doc/images/PNG/'.$Signe2.'.png" height="105" width="95" />';
	//log::add('Horoscope', 'debug', 'ID : '.$ID.' et icone : '.'<img src="plugins/Horoscope/doc/images/PNG/'.$Signe2.'.png" height="105" width="95" />');
	//log::add('Horoscope', 'debug', 'Signe Image : '.$Signe2)
	echo "</center>";
	echo '<span style="font-size : 1.1em;position:relative; top : 15px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;"><center>' . $eqLogic->getHumanName(true, true) . '</center></span>';
	echo '</div>';
}
?>
</div>
</div>

<div class="col-lg-10 col-md-9 col-sm-8 eqLogic" style="border-left: solid 1px #EEE; padding-left: 25px;display: none;">
    <form class="form-horizontal">
        <fieldset>
            <legend><i class="fa fa-arrow-circle-left eqLogicAction cursor" data-action="returnToThumbnailDisplay"></i> {{Général}}  <i class='fa fa-cogs eqLogicAction pull-right cursor expertModeVisible' data-action='configure'></i></legend>
            <div class="form-group">
                <label class="col-sm-3 control-label">{{Nom de la personne}}</label>
                <div class="col-sm-3">
                    <input type="text" class="eqLogicAttr form-control" data-l1key="id" style="display : none;" />
                    <input type="text" class="eqLogicAttr form-control" data-l1key="name" placeholder="{{Nom de la personne}}"/>
                </div>
            </div>








            <div class="form-group">
                <label class="col-sm-3 control-label" >{{Objet parent}}</label>
                <div class="col-sm-3">
                    <select id="sel_object" class="eqLogicAttr form-control" data-l1key="object_id">
                        <option value="">{{Aucun}}</option>
                        <?php
foreach (object::all() as $object) {
	echo '<option value="' . $object->getId() . '">' . $object->getName() . '</option>';
}
?>
                   </select>
               </div>
           </div>


<div class="form-group">
<label class="col-sm-3 control-label">{{Signe}}</label>
<div class="col-sm-3"> <select class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="Signe">
<option value="Bélier">Bélier</option>
<option value="Taureau">Taureau</option>
<option value="Gémeaux">Gémeaux</option>
<option value="Cancer">Cancer</option>
<option value="Lion">Lion</option>
<option value="Vierge">Vierge</option>
<option value="Balance">Balance</option>
<option value="Scorpion">Scorpion</option>
<option value="Sagittaire">Sagittaire</option>
<option value="Capricorne">Capricorne</option>
<option value="Verseau">Verseau</option>
<option value="Poissons">Poissons</option>

</select>
</div>
</div>







           <div class="form-group">
            <label class="col-sm-3 control-label" >{{Activer}}</label>
            <div class="col-sm-9">
               <input type="checkbox" class="eqLogicAttr bootstrapSwitch" data-label-text="{{Activer}}" data-l1key="isEnable" checked/>
               <input type="checkbox" class="eqLogicAttr bootstrapSwitch" data-label-text="{{Visible}}" data-l1key="isVisible" checked/>
           </div>
       </div>

<?php
 //      <div class="form-group">
 //       <label class="col-sm-3 control-label">{{Horoscope param 1}}</label>
 //       <div class="col-sm-3">
 //           <input type="text" class="eqLogicAttr configuration form-control" data-l1key="configuration" data-l2key="city" placeholder="param1"/>
  //      </div>
 //   </div>
?>
</fieldset>
</form>

<legend>{{Horoscope}}</legend>
<a class="btn btn-success btn-sm cmdAction" data-action="add"><i class="fa fa-plus-circle"></i> {{Commandes}}</a><br/><br/>
<table id="table_cmd" class="table table-bordered table-condensed">
    <thead>
        <tr>
            <th>{{Nom}}</th><th>{{Type}}</th><th>{{Action}}</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<form class="form-horizontal">
    <fieldset>
        <div class="form-actions">
            <a class="btn btn-danger eqLogicAction" data-action="remove"><i class="fa fa-minus-circle"></i> {{Supprimer}}</a>
            <a class="btn btn-success eqLogicAction" data-action="save"><i class="fa fa-check-circle"></i> {{Sauvegarder}}</a>
        </div>
    </fieldset>
</form>

</div>
</div>
<?php //include_file('desktop', 'Horoscope', 'js', 'Horoscope');?>
<?php //include_file('desktop', 'template', 'js', 'template');?>
<?php //include_file('core', 'plugin.template', 'js');?>

<?php include_file('desktop', 'Horoscope', 'js', 'Horoscope');?>
<?php include_file('core', 'plugin.ajax', 'js'); ?>
<?php include_file('core', 'plugin.template', 'js');?>