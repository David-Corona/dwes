<?php include __DIR__ . '/partials/inicio-doc.part.php'; ?>

 </head>
<body>
    <?php include __DIR__ . '/partials/header.part.php'; ?>

     <div class="main">
      <div class="shop_top">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
				  <div class="map">
					<iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Lighthouse+Point,+FL,+United+States&amp;aq=4&amp;oq=light&amp;sll=26.275636,-80.087265&amp;sspn=0.04941,0.104628&amp;ie=UTF8&amp;hq=&amp;hnear=Lighthouse+Point,+Broward,+Florida,+United+States&amp;t=m&amp;z=14&amp;ll=26.275636,-80.087265&amp;output=embed"></iframe><br><small><a href="https://maps.google.co.in/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Lighthouse+Point,+FL,+United+States&amp;aq=4&amp;oq=light&amp;sll=26.275636,-80.087265&amp;sspn=0.04941,0.104628&amp;ie=UTF8&amp;hq=&amp;hnear=Lighthouse+Point,+Broward,+Florida,+United+States&amp;t=m&amp;z=14&amp;ll=26.275636,-80.087265" style="color:#666;text-align:left;font-size:12px"></a></small>
				  </div>
				</div>
				<div class="col-md-5">
					<p class="m_8">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat</p>
					<div class="address">
				                <p>500 Lorem Ipsum Dolor Sit,</p>
						   		<p>22-56-2-9 Sit Amet, Lorem,</p>
						   		<p>USA</p>
				   		<p>Phone:(00) 222 666 444</p>
				   		<p>Fax: (000) 000 00 00 0</p>
				 	 	<p>Email: <span>support[at]snow.com</span></p>
				   		<p>Follow on: <span>Facebook</span>, <span>Twitter</span></p>
				   </div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 contact">
                    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
                        <div class="alert alert-<?= empty($errores) ? 'success' : 'danger'; ?> alert-dismissible" role="alert">
                            <!--<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>-->
                            <?php if(empty($errores)) : ?>
                                <p><?= $GLOBALS['mensajeOk'] ?></p>
                                <ul>
                                    <li>Nombre: <?= $GLOBALS['nombre'] ?></li>
                                    <li>Apellidos: <?= $GLOBALS['apellidos'] ?></li>
                                    <li>Email: <?= $GLOBALS['email'] ?></li>
                                    <li>Asunto: <?= $GLOBALS['asunto'] ?></li>
                                    <li>Mensaje: <?= $GLOBALS['texto'] ?></li>
                                </ul>
                            <?php else : ?>
                                <ul>
                                    <?php foreach($errores as $error) : ?>
                                        <li><?= $error ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
                        <div class="left-contact">
                            <p><label for="nombre">(*) Nombre</label>
                           <input type="text" class="text" name="nombre" value="<?= $GLOBALS['nombre'] ?>" required></p>
                            <p><label for="nombre">Apellidos</label>
                           <input type="text" class="text" name="apellidos" value="<?= $GLOBALS['apellidos'] ?>" ></p>
                            <p><label for="nombre">(*) Email</label>
                           <input type="text" class="text" name="email" value="<?= $GLOBALS['email'] ?>" required></p>
                       </div>
                       <div class="right-contact">
                           <p><label for="nombre">(*) Asunto</label>
                           <input type="text" class="text" name="asunto" value="<?= $GLOBALS['asunto'] ?>" required></p>
                           <p><label for="nombre">Mensaje</label>
                           <textarea name="texto" ><?= $GLOBALS['texto'] ?></textarea></p>
                           <div class="form-submit">
                              <input name="submit" type="submit" id="submit" value="Submit"><br>
                           </div>
                       </div>
                       <div class="clear">Los campos marcados con (*) son obligatorios.</div>
                   </form>
			     </div>
		    </div>
	     </div>
	   </div>
	  </div>

    <?php include __DIR__ . '/partials/fin-doc.part.php'; ?>

</body>	
</html>