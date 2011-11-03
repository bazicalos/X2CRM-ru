<?php
/*********************************************************************************
 * X2Engine is a contact management program developed by
 * X2Engine, Inc. Copyright (C) 2011 X2Engine Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY X2Engine, X2Engine DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact X2Engine, Inc. at P.O. Box 66752,
 * Scotts Valley, CA 95067, USA. or at email address contact@X2Engine.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * X2Engine" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by X2Engine".
 ********************************************************************************/

$this->menu=array(
	array('label'=>Yii::t('users','Manage Users'), 'url'=>array('admin')),
	array('label'=>Yii::t('users','Create User'), 'url'=>array('create')),
	array('label'=>Yii::t('users','View User')),
	array('label'=>Yii::t('users','Update User'), 'url'=>array('update', 'id'=>$model->id)),
        array('label'=>Yii::t('contacts','Delete User'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('app','Are you sure you want to delete this item?'))),
);
?>
<h1><?php echo Yii::t('users','User: {name}',array('{name}'=>$model->firstName.' '.$model->lastName)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'baseScriptUrl'=>'/x2engine/themes/'.Yii::app()->theme->name.'/css/detailview',
	'attributes'=>array(
		'firstName',
		'lastName',
		'username',
		'title',
		'department',
		'officePhone',
		'cellPhone',
		'homePhone',
		'address',
		'backgroundInfo',
		'emailAddress',
		'status',
	),
)); ?>

<h2>Action History</h2>

<?php
foreach($actionHistory as $action) {
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$action,
		'baseScriptUrl'=>Yii::app()->request->baseUrl.'/themes/'.Yii::app()->theme->name.'/css/detailview',
		'attributes'=>array(
			array(
				'label'=>'Action Description',
				'type'=>'raw',
				'value'=>CHtml::link(CHtml::encode($action->actionDescription),
							 array('actions/view','id'=>$action->id)),
			),
			'assignedTo',
			'dueDate',
			array(
				'label'=>'Complete',
				'type'=>'raw',
				'value'=>CHtml::tag("b",array(),CHtml::tag("font",$htmlOptions=array('color'=>'green'),CHtml::encode($action->complete)))
			),
			'priority',
			'type',
			'createDate',
		),
	));
}
?><br /><br />