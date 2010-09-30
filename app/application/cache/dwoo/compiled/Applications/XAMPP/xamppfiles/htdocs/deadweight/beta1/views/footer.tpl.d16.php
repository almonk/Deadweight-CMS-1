<?php
ob_start(); /* template body */ ?>		</div>
	</body>
</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>