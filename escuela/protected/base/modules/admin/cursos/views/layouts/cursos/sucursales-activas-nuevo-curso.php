<?php
	use yii\helpers\Html;
	use yii\helpers\Url;
	use yii\helpers\Json;
	use base\widgets\faicons\Fa;
	use yii\bootstrap\ActiveForm;
	use yii\helpers\ArrayHelper;
	use yii\widgets\ListView;
	use yii\widgets\Pjax;

	Pjax::begin([
		'id'                => $this->context->pjaxId,
		'enablePushState'   => false,
	]);
?>

<div class="row" id="<?= $this->context->pjaxId; ?>">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo Fa::icon($this->iconClass); ?>
					<?= $this->H1; ?>
				</h3>
			</div>
			<div class="panel-body" >
				<div class="container-fluid margin-v-30">
					<div class="row">
						<div class="col-md-9 col-sm-12 col-xs-12">
							<div class="container-fluid">
								<div class="row">
									<div class="col-md-12">
										<?php
											if(empty($sucursales))
												echo $this->render('@layouts/partial/sin-sucursal');

											else{
												$form = ActiveForm::begin([
													'id'					=> 'form' . $this->suffixDOM,
													'enableClientScript'    => true,
												]);

												echo $this->render('_create_sucursales-items', [
													'sucursales' => $sucursales,
												]);

												$form::end();
											}
										?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 text-center">
									<?php
											if($this->context->model->is_tmp == true)
											{
												echo Html::a(Yii::t('app', 'Cancelar'), Url::toRoute(['/' . $this->context->module->id . '/create/cancel' ]), [
													'class'     => 'btn btn-danger',
													'style'     => 'margin-right:10px',
													'data-pjax' => 0,
													'data-title-confirm'    => Yii::t('app', 'Cancelar'),
													'data-text-confirm'     => Yii::t('app', '¿Esta seguro que desea cancelar el registro?'),
													'data-runtime'          => 'ajax-confirm',
													'data-label-btn-cancel' => Yii::t('yii', 'No'),
													'data-label-btn-ok'     => Yii::t('yii', 'Yes'),
													'data-icon-class'       => 'fa fa-trash',
													'data-force-redirect'	=>  Url::toRoute(['/' . $this->context->module->id . '/create/index']),
												]);
												echo Html::a(Fa::icon('arrow-left')->fw() . ' ' . Yii::t('app','Anterior') 		 , Url::toRoute(['/' . $this->context->module->id . '/create/examenes']) ,['style'=>'margin-right:10px','class' => 'btn btn-primary', 'data-pjax' => 0]);
											}
									?>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-3 col-sm-12 col-xs-12">
							<?php
								if($this->context->model->is_tmp || $this->context->model->isNewRecord)
									echo $this->render('_menuCreate');
								else
									echo $this->render('_menu');
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php Pjax::end(); ?>
