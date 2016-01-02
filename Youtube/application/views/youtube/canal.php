<?php
	$this->load->view('inc/cabecera');
?>

<main class="container">
    <div class="col-md-8">
        <div class="portada">
            <div class="title"><?=$user->username?></div>
        </div>
        <iframe src="http://www.youtube.com/embed/<?=substr($last_video->url, 32, 30);?>" class="video"></iframe>
        <div class="description">
            <div class="row"><h3><?=$last_video->title?></h3></div>
            <div class="row video-info">
                <div class="col-md-4">By <?=$user->username?></div>
                <div class="col-md-4"><?=$last_video->visits?> visualizaciones</div>
                <div class="col-md-4">Hace 4 días</div>
                </div>
            <div class="row video-description">
	            <?=$last_video->description?>
            </div>
        </div>
        <div class="row space"></div>
        <section class="col-md-12">
            <div class="row">
                <div class="col-md-12">
					<ul class="nav nav-tabs">
					    <li class="active"><a data-toggle="tab" href="#videos">Videos</a></li>
					    <li><a data-toggle="tab" href="#comentarios">Comentarios</a></li>
				  	</ul>
                </div>
            </div>

            <div class="tab-content margin-top">
            	<div id="videos" class="row tab-pane fade in active">
            					<?php foreach ($videos as $video) { ?>
            	    <div class="col-md-3">
            	        <h5><?=$video->title?></h5>
            	        <img src="http://img.youtube.com/vi/<?=substr($video->url, 32, 30);?>/0.jpg" alt="" class="videos-image"/>
            	    </div>
            					<?php } ?>
            	</div>
				<div id="comentarios" class="row tab-pane fade">
					<div class="row margin-bottom">
						<div class="col-md-12">
							<div id="error"></div>
						</div>
						<form method="post" accept-charset="utf-8">
							<input type="hidden" name="channel" value="<?=$user->id?>">
							<input type="hidden" name="user" value="<?php if( isset($_SESSION['id']) ){ echo $_SESSION['id']; }else {echo '0';} ?>">
							<div class="col-md-10">
								<textarea name="comment" rows="4" cols="40" class="form-control comment-box"></textarea>
							</div>
							<div class="col-md-2 margin-top"><button class="btn btn-primary margin-top">Enviar</button></div>
						</form>
						<script type="text/javascript">
							$('form').submit(function(event){
								event.preventDefault();
								var formData = {
						            'channel'              : $('input[name=channel]').val(),
						            'user'             : $('input[name=user]').val(),
						            'comment'    : $('textarea[name=comment]').val()
						        };
								console.log(formData);
								if(formData.user == 0)
								{
									$('#error').html('<div class="alert alert-danger"><strong>Error!</strong> Debes iniciar sesión</div>')
								}
								else {
									$.ajax({
										url: '<?=site_url('/canal/nuevo_comentario')?>',
										type: 'POST',
										data: formData
									});
									location.reload();
								}
							});
						</script>
						<hr>
					</div>
					<?php foreach($comentarios as $comentario) { ?>
			            <div class="row margin-bottom">
			                <div class="col-sm-12">
			                    <div class="col-md-2"><img src="http://lorempixel.com/100/100" alt="" class="comment-image img-circle"></div>
			                    <div class="col-md-10">
			                        <div class="row">
			                            <div class="col-sm-6"><h4><?=$comentario->username?></h4></div>
			                            <div class="col-sm-6 right"><em class="date"><?=$comentario->date?></em></div>
			                        </div>
			                        <div class="row">
			                            <div class="col-sm-12">
			                                <?=$comentario->comment?>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			            </div>
					<?php } ?>
	            </div>
            </div>

        </section>
    </div>
    <div class="col-md-4">
       <section class="profile center">
            <img src="http://lorempixel.com/100/100" alt="" class="imagen img-circle">
            <h4><?=$user->username?></h4>
            <div class="btn-group">
                <button class="btn btn-youtube"><i class="gyphicon glyphicon-plus"></i> Suscribirse</button>
                <div class="btn btn-default">128.915 segidores</div>
            </div>
       </section>
        <section class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <h4>Relacionados</h4>
                    <hr>
                </div>
            </div>
			<?php foreach ($related as $rel) { ?>
            <div class="row margin-bottom">
                <div class="col-sm-12">
                    <div class="col-sm-4">
                        <img src="http://lorempixel.com/100/100" alt="" class="relacionados-imagen img-circle">
                    </div>
                    <div class="col-sm-8 relacionados-channel">
                        <div class="row"><span class="relacionados-user"><?=$rel->username?></span></div>
                        <div class="row"><span class="relacionados-thumb">124.324 Suscriptores</span></div>
                    </div>
                </div>
            </div>
			<?php } ?>
        </section>
    </div>
</main>

<?php
	$this->load->view('inc/pie.php');
?>
