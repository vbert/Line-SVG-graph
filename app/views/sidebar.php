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
			<div class="col-xs-6">
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
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-text-height" title="Rozmiar czcionki tytułu"></i></span>
					<?=form_dropdown('graph_title_font_size', $options, $select, $more);?>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="input-group" id="graphTitleColour">
					<?=form_input(array('id'=>'graph_title_colour','name'=>'graph_title_colour',
										'class'=>'form-control input-sm','placeholder'=>'Kolor tytułu',
										'value'=>$post['graph_title_colour']));?>
					<span class="input-group-addon"><i></i></span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<div class="form-group">
					<?=form_label('Tło wykresu', 'back_colour');?>
					<div class="input-group" id="graphBgColour">
						<?=form_input(array('id'=>'back_colour','name'=>'back_colour',
											'class'=>'form-control input-sm','placeholder'=>'Kolor tła',
											'value'=>$post['back_colour']));?>
						<span class="input-group-addon"><i></i></span>
					</div>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="form-group">
					<?=form_label('Prom. narożników', 'back_round');?>
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
		<div class="form-group">
			<?=form_label('Etykiety danych', 'labels');?>
			<?=form_textarea(array('id'=>'labels','name'=>'labels',
								   'class'=>'form-control input-sm','placeholder'=>'Wpisz etykiety oddzielając je średnikiem ";"',
								   'rows'=>2,'value'=>$post['labels']));?>
		</div>
		<div class="form-group">
			<?=form_label('Serie danych', 'seriesTab');?>
		</div>
		<ul id="seriesTab" class="nav nav-tabs">
			<li class="active"><a href="#s1" data-toggle="tab">1</a></li>
			<li><a href="#s2" data-toggle="tab">2</a></li>
			<li><a href="#s3" data-toggle="tab">3</a></li>
		</ul>
		<div id="seriesContent" class="tab-content">
			<div class="tab-pane fade in active" id="s1">
				<div class="form-group">
					<?=form_label('Dane oddzielone średnikiem', 'data_s1');?>
					<?=form_textarea(array('id'=>'data_s1','name'=>'series[]','class'=>'form-control input-sm',
										   'placeholder'=>'Wpisz dane oddzielając je średnikiem ";"',
										   'rows'=>2,'value'=>$post['series'][0]));?>
				</div>
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							<?=form_label('Kolor 1', 'K-1-0');?>
							<div class="input-group colourSeries">
								<?=form_input(array('id'=>'K-1-0','name'=>'colours[0][]',
													'class'=>'form-control input-sm',
													'value'=>$post['colours'][0][0]));?>
								<span class="input-group-addon"><i></i></span>
							</div>
						</div>
					</div>
					<div class="col-xs-6">
						<div class="form-group">
							<?=form_label('Kolor 2', 'K-1-1');?>
							<div class="input-group colourSeries">
								<?=form_input(array('id'=>'K-1-1','name'=>'colours[0][]',
													'class'=>'form-control input-sm',
													'value'=>$post['colours'][0][1]));?>
								<span class="input-group-addon"><i></i></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="s2">
				<div class="form-group">
					<?=form_label('Dane oddzielone średnikiem', 'data_s2');?>
					<?=form_textarea(array('id'=>'data_s2','name'=>'series[]','class'=>'form-control input-sm',
										   'placeholder'=>'Wpisz dane oddzielając je średnikiem ";"',
										   'rows'=>2,'value'=>$post['series'][1]));?>
				</div>
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							<?=form_label('Kolor 1', 'K-2-0');?>
							<div class="input-group colourSeries">
								<?=form_input(array('id'=>'K-2-0','name'=>'colours[1][]',
													'class'=>'form-control input-sm',
													'value'=>$post['colours'][1][0]));?>
								<span class="input-group-addon"><i></i></span>
							</div>
						</div>
					</div>
					<div class="col-xs-6">
						<div class="form-group">
							<?=form_label('Kolor 2', 'K-2-1');?>
							<div class="input-group colourSeries">
								<?=form_input(array('id'=>'K-2-1','name'=>'colours[1][]',
													'class'=>'form-control input-sm',
													'value'=>$post['colours'][1][1]));?>
								<span class="input-group-addon"><i></i></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="s3">
				<div class="form-group">
					<?=form_label('Dane oddzielone średnikiem', 'data_s3');?>
					<?=form_textarea(array('id'=>'data_s3','name'=>'series[]','class'=>'form-control input-sm',
										   'placeholder'=>'Wpisz dane oddzielając je średnikiem ";"',
										   'rows'=>2,'value'=>$post['series'][2]));?>
				</div>
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							<?=form_label('Kolor 1', 'K-3-0');?>
							<div class="input-group colourSeries">
								<?=form_input(array('id'=>'K-3-0','name'=>'colours[2][]',
													'class'=>'form-control input-sm',
													'value'=>$post['colours'][2][0]));?>
								<span class="input-group-addon"><i></i></span>
							</div>
						</div>
					</div>
					<div class="col-xs-6">
						<div class="form-group">
							<?=form_label('Kolor 2', 'K-3-1');?>
							<div class="input-group colourSeries">
								<?=form_input(array('id'=>'K-3-1','name'=>'colours[2][]',
													'class'=>'form-control input-sm',
													'value'=>$post['colours'][2][1]));?>
								<span class="input-group-addon"><i></i></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>