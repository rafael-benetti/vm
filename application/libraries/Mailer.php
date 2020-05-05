<?php
class Mailer 
{
	function __construct()
	{
		$this->CI =& get_instance();
	}
	//=============================================================
	function registration_email($username, $email_verification_link)
	{
    $login_link = base_url('auth/login');  

		$tpl = '<h3>Hi ' .strtoupper($username).'</h3>
            <p>Bem Vindo ao VMsis!</p>
            <p>Ative sua conta com o link acima e inicie o seu login:</p>  
            <p>'.$email_verification_link.'</p>

            <br>
            <br>

            <p>Regards, <br> 
               Atltech Team<br> 
            </p>
    ';
		return $tpl;		
	}

	//=============================================================
	function pwd_reset_email($username, $reset_link)
	{
		$tpl = '<h3>Olá ' .strtoupper($username).'</h3>
            <p>Bem Vindo ao VMsis!</p>
            <p>Recebemos sua solicitação para redefinir sua senha. Se você não iniciou esta solicitação, pode simplesmente ignorar esta mensagem e nenhuma ação será tomada..</p> 
            <p>Para redefinir sua senha, clique no link abaixo:</p> 
            <p>'.$reset_link.'</p>

            <br>
            <br>

            <p>© 2018 Altech - All rights reserved</p>
    ';
		return $tpl;		
	}

	

}
?>