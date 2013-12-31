<?php echo form_open('refresh_graph', array('id'=>'formPropertiesGraph')); ?>
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
								   'class'=>'form-control','placeholder'=>'Wpisz tytuł',
								   'rows'=>2,'value'=>$post['graph_title']));?>
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