<?=form_open('refresh_graph', array('id'=>'formPropertiesGraph')); ?>
<?=form_button(array('id'=>'btn_refresh_graph',
					 'name'=>'btn_refresh_graph',
					 'type'=>'submit',
					 'content'=>'<span class="glyphicon glyphicon-refresh"></span> Odśwież wykres',
					 'class'=>'btn btn-default btn-block'));?>
<br>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="glyphicon glyphicon-cog"></span> Właściwości wykresu</h3>
	</div>
	<div class="panel-body">
		<div class="form-group">
			<?=form_label('Tytuł wykresu', 'graph_title');?>
			<?=form_textarea(array('id'=>'graph_title','name'=>'graph_title',
								   'class'=>'form-control input-sm','placeholder'=>'Wpisz tytuł',
								   'rows'=>2,'value'=>$post['graph_title']));?>
		</div>
		<div class="row">
			<div class="col-xs-5">
				<?php
				$options = array(
					'12px' => '12 px',
					'14px' => '14 px',
					'17px' => '17 px',
					'20px' => '20 px'
				);
				$select = $post['graph_title_font_size'];
				$more = 'id="graph_title_font_size" class="form-control input-sm" title="Rozmiar czcionki tytułu"';
				?>
				<?=form_dropdown('graph_title_font_size', $options, $select, $more);?>
			</div>
			<div class="col-xs-7">
				<div class="input-group" id="graphTitleColour">
					<?=form_input(array('id'=>'graph_title_colour','name'=>'graph_title_colour',
										'class'=>'form-control input-sm','placeholder'=>'Kolor tytułu',
										'value'=>$post['graph_title_colour']));?>
					<span class="input-group-addon"><i></i></span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<?=form_label('Tło wykresu', 'back_colour');?>
			<div class="row">
				<div class="col-xs-7">
					<div class="input-group" id="graphBgColour">
						<?=form_input(array('id'=>'back_colour','name'=>'back_colour',
											'class'=>'form-control input-sm','placeholder'=>'Kolor tła',
											'value'=>$post['back_colour']));?>
						<span class="input-group-addon"><i></i></span>
					</div>
				</div>
				<div class="col-xs-5">
					<?=form_input(array('id'=>'back_round','name'=>'back_round',
										'class'=>'form-control input-sm','title'=>'Promień zaokrąglenia narożników',
										'value'=>$post['back_round']));?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="glyphicon glyphicon-stats"></span> Serie danych</h3>
	</div>
	<div class="panel-body">
		Panel content
	</div>
</div>
<?php echo form_close(); ?>