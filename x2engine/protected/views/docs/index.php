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

$this->breadcrumbs=array(
	'Docs',
);

$this->menu=array(
        array('label'=>Yii::t('docs','List Docs')),
		array('label'=>Yii::t('docs','Create Doc'), 'url'=>array('create')),
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('contacts-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model, 
)); ?>
</div><!-- search-form -->
<?php
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'docs-grid',
	'baseScriptUrl'=>Yii::app()->request->baseUrl.'/themes/'.Yii::app()->theme->name.'/css/gridview',
	'template'=> '<h2>'.Yii::t('docs','Documents').'</h2><div class="title-bar">'
		.CHtml::link(Yii::t('app','Advanced Search'),'#',array('class'=>'search-button')) . ' | '
		.CHtml::link(Yii::t('app','Clear Filters'),array('index','clearFilters'=>1))
		.'{summary}</div>{items}{pager}',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'title',
			'value'=>'CHtml::link($data->title,array("view","id"=>$data->id))',
			'type'=>'raw',
			'htmlOptions'=>array('width'=>'30%'),
		),
		array(
			'name'=>'createdBy',
			'value'=>'UserChild::getUserLinks($data->createdBy)',
			'type'=>'raw',
		),
		array(
			'name'=>'updatedBy',
			'value'=>'UserChild::getUserLinks($data->updatedBy)',
			'type'=>'raw',
		),
		array(
			'name'=>'createDate',
			'type'=>'raw',
			'value'=>'date("Y-m-d",$data->createDate)',
		),
		array(
			'name'=>'lastUpdated',
			'type'=>'raw',
			'value'=>'date("Y-m-d",$data->lastUpdated)',
		),
	),
)); ?>
<br />
<?php
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'attachments-grid',
	'baseScriptUrl'=>Yii::app()->request->baseUrl.'/themes/'.Yii::app()->theme->name.'/css/gridview',
	'template'=> '<h2>'.Yii::t('docs','Uploaded Documents').'</h2><div class="title-bar">'
		.'{summary}</div>{items}{pager}',
	'dataProvider'=>$attachments,
	'columns'=>array(
		array(
			'name'=>'fileName',
			'value'=>'CHtml::link($data->fileName,array("media/view","id"=>$data->id))',
			'type'=>'raw',
			'htmlOptions'=>array('width'=>'30%'),
		),
		array(
			'name'=>'uploadedBy',
			'value'=>'UserChild::getUserLinks($data->uploadedBy)',
			'type'=>'raw',
		),
		array(
			'name'=>'createDate',
			'type'=>'raw',
			'value'=>'date("Y-m-d",$data->createDate)',
		),
	),
)); ?>


<div id="attachment-form">
	<?php $this->widget('Attachments',array('type'=>'docs','associationId'=>$model->id)); ?>
</div>