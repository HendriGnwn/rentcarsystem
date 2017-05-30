<?php

use dmstr\widgets\Alert;
use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\widgets\Breadcrumbs;

?>
<div class="content-wrapper">
    <section class="content-header">
        <?php if (isset($this->blocks['content-header'])) { ?>
            <h1><?= $this->blocks['content-header'] ?></h1>
        <?php } else { ?>
            <h1>
                <?php
                if ($this->title !== null) {
                    echo Html::encode($this->title);
                } else {
                    echo Inflector::camel2words(
                        Inflector::id2camel($this->context->module->id)
                    );
                    echo ($this->context->module->id !== Yii::$app->id) ? '<small>Module</small>' : '';
                } ?>
            </h1>
        <?php } ?>

        <?=
        Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
    </section>

    <section class="content">
		<?php if ( isset($rbacMenu) && $rbacMenu == true) { ?>
			<?= Nav::widget([
				'options' => ['class' => 'nav nav-tabs'],
				'items' => [
					['label'=>'Assignments', 'url'=>['assignment/index']],
					['label'=>'Permissions', 'url'=>['permission/index']],
					['label'=>'Roles', 'url'=>['role/index']],
					['label'=>'Rules', 'url'=>['rule/index']],
					['label'=>'Routes', 'url'=>['route/index']],
					['label'=>'Menus', 'url'=>['menu/index']],
				],
			]) ?>
		<?php } ?>
		
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.0
    </div>
    <strong>Copyright &copy; 2017 <a href="#">Rent Car System</a>.</strong> All rights
    reserved.
</footer>
<div class='control-sidebar-bg'></div>