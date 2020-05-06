<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-04-29 21:57:01 --> Severity: error --> Exception: Call to undefined method User_model::get_total_estoque_machines() C:\xampp\htdocs\altechindustria\vm\application\controllers\admin\Users.php 57
ERROR - 2020-04-29 21:57:53 --> Severity: Notice --> Undefined variable: id_maquina C:\xampp\htdocs\altechindustria\vm\application\controllers\admin\Users.php 29
ERROR - 2020-04-29 22:12:42 --> Severity: Notice --> Undefined variable: machine C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 22
ERROR - 2020-04-29 22:12:42 --> Severity: Notice --> Undefined variable: id_maquina C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 99
ERROR - 2020-04-29 22:12:42 --> Severity: Notice --> Undefined variable: item C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 179
ERROR - 2020-04-29 22:12:42 --> Severity: Notice --> Undefined variable: id_maquina C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 191
ERROR - 2020-04-29 22:12:42 --> Severity: Notice --> Undefined variable: item C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 192
ERROR - 2020-04-29 22:13:32 --> Severity: Notice --> Undefined index: firtsname C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 22
ERROR - 2020-04-29 22:13:32 --> Severity: Notice --> Undefined variable: id_maquina C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 99
ERROR - 2020-04-29 22:13:32 --> Severity: Notice --> Undefined variable: item C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 179
ERROR - 2020-04-29 22:13:32 --> Severity: Notice --> Undefined variable: id_maquina C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 191
ERROR - 2020-04-29 22:13:32 --> Severity: Notice --> Undefined variable: item C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 192
ERROR - 2020-04-29 22:13:36 --> Severity: Notice --> Undefined index: firtsname C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 22
ERROR - 2020-04-29 22:13:36 --> Severity: Notice --> Undefined variable: id_maquina C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 99
ERROR - 2020-04-29 22:13:36 --> Severity: Notice --> Undefined variable: item C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 179
ERROR - 2020-04-29 22:13:36 --> Severity: Notice --> Undefined variable: id_maquina C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 191
ERROR - 2020-04-29 22:13:36 --> Severity: Notice --> Undefined variable: item C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 192
ERROR - 2020-04-29 22:13:58 --> Severity: Notice --> Undefined variable: id_maquina C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 99
ERROR - 2020-04-29 22:13:58 --> Severity: Notice --> Undefined variable: item C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 179
ERROR - 2020-04-29 22:13:58 --> Severity: Notice --> Undefined variable: id_maquina C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 191
ERROR - 2020-04-29 22:13:58 --> Severity: Notice --> Undefined variable: item C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 192
ERROR - 2020-04-29 22:14:46 --> Severity: Notice --> Undefined variable: id_maquina C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 99
ERROR - 2020-04-29 22:14:46 --> Severity: Notice --> Undefined variable: item C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 179
ERROR - 2020-04-29 22:14:46 --> Severity: Notice --> Undefined variable: id_maquina C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 191
ERROR - 2020-04-29 22:14:46 --> Severity: Notice --> Undefined variable: item C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 192
ERROR - 2020-04-29 22:26:45 --> Severity: error --> Exception: syntax error, unexpected 'count' (T_STRING), expecting ',' or ')' C:\xampp\htdocs\altechindustria\vm\application\models\admin\User_model.php 86
ERROR - 2020-04-29 22:26:50 --> Query error: Unknown column 'm.nome_imagem' in 'field list' - Invalid query: SELECT `m`.`nome_imagem`, `m`.`observacoes_equipamento` as `nome_maquina`, `t`.`tipo` as `nome_tipo`, `p`.`ponto`, `p`.`nomefan`
FROM `ci_machines`
JOIN `ci_tipos` `t` ON `t`.`id` = `m`.`tipomaquina`
JOIN `ci_pontos` `p` ON `p`.`id` = `up`.`pontoid`
WHERE `up`.`user_id` = '46'
ERROR - 2020-04-29 22:27:36 --> Query error: Unknown column 'm.observacoes_equipamento' in 'field list' - Invalid query: SELECT `m`.`nome_imagem`, `m`.`observacoes_equipamento` as `nome_maquina`, `t`.`tipo` as `nome_tipo`, `p`.`ponto`, `p`.`nomefan`
FROM `ci_machines` `m`
JOIN `ci_tipos` `t` ON `t`.`id` = `m`.`tipomaquina`
JOIN `ci_pontos` `p` ON `p`.`id` = `up`.`pontoid`
WHERE `up`.`user_id` = '46'
ERROR - 2020-04-29 22:27:47 --> Query error: Unknown column 'up.user_id' in 'where clause' - Invalid query: SELECT `m`.`nome_imagem`, `m`.`observacoes_equip` as `nome_maquina`, `t`.`tipo` as `nome_tipo`, `p`.`ponto`, `p`.`nomefan`
FROM `ci_machines` `m`
JOIN `ci_tipos` `t` ON `t`.`id` = `m`.`tipomaquina`
JOIN `ci_pontos` `p` ON `p`.`id` = `up`.`pontoid`
WHERE `up`.`user_id` = '46'
ERROR - 2020-04-29 22:27:49 --> Query error: Unknown column 'up.user_id' in 'where clause' - Invalid query: SELECT `m`.`nome_imagem`, `m`.`observacoes_equip` as `nome_maquina`, `t`.`tipo` as `nome_tipo`, `p`.`ponto`, `p`.`nomefan`
FROM `ci_machines` `m`
JOIN `ci_tipos` `t` ON `t`.`id` = `m`.`tipomaquina`
JOIN `ci_pontos` `p` ON `p`.`id` = `up`.`pontoid`
WHERE `up`.`user_id` = '46'
ERROR - 2020-04-29 22:28:56 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '.`ponto_id` ON `up`.`id` = `p`.`id`
JOIN `ci_tipos` `t` ON `t`.`id` = `m`.`tipom' at line 3 - Invalid query: SELECT `m`.`nome_imagem`, `m`.`observacoes_equip` as `nome_maquina`, `t`.`tipo` as `nome_tipo`, `p`.`ponto`, `p`.`nomefan`
FROM `ci_machines` `m`
JOIN `ci_users_pontos` `up`.`ponto_id` ON `up`.`id` = `p`.`id`
JOIN `ci_tipos` `t` ON `t`.`id` = `m`.`tipomaquina`
JOIN `ci_pontos` `p` ON `p`.`id` = `up`.`pontoid`
WHERE `up`.`user_id` = '46'
ERROR - 2020-04-29 22:29:18 --> Query error: Unknown column 'p.id' in 'on clause' - Invalid query: SELECT `m`.`nome_imagem`, `m`.`observacoes_equip` as `nome_maquina`, `t`.`tipo` as `nome_tipo`, `p`.`ponto`, `p`.`nomefan`
FROM `ci_machines` `m`
JOIN `ci_users_pontos` `up` ON `up`.`ponto_id` = `p`.`id`
JOIN `ci_tipos` `t` ON `t`.`id` = `m`.`tipomaquina`
JOIN `ci_pontos` `p` ON `p`.`id` = `up`.`pontoid`
WHERE `up`.`user_id` = '46'
ERROR - 2020-04-29 22:29:34 --> Query error: Unknown column 'p.id' in 'on clause' - Invalid query: SELECT `m`.`nome_imagem`, `m`.`observacoes_equip` as `nome_maquina`, `t`.`tipo` as `nome_tipo`, `p`.`ponto`, `p`.`nomefan`
FROM `ci_machines` `m`
JOIN `ci_users_pontos` `up` ON `up`.`ponto_id` = `p`.`id`
JOIN `ci_tipos` `t` ON `t`.`id` = `m`.`tipomaquina`
JOIN `ci_pontos` `p` ON `p`.`id` = `up`.`ponto_id`
WHERE `up`.`user_id` = '46'
ERROR - 2020-04-29 22:30:27 --> Query error: Unknown column 'up.ponto_id' in 'on clause' - Invalid query: SELECT `m`.`nome_imagem`, `m`.`observacoes_equip` as `nome_maquina`, `t`.`tipo` as `nome_tipo`, `p`.`ponto`, `p`.`nomefan`
FROM `ci_machines` `m`
JOIN `ci_pontos` `p` ON `p`.`id` = `up`.`ponto_id`
JOIN `ci_users_pontos` `up` ON `up`.`ponto_id` = `p`.`id`
JOIN `ci_tipos` `t` ON `t`.`id` = `m`.`tipomaquina`
WHERE `up`.`user_id` = '46'
ERROR - 2020-04-29 22:31:55 --> Severity: Notice --> Undefined variable: id_maquina C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 97
ERROR - 2020-04-29 22:31:55 --> Severity: Notice --> Undefined variable: pontos C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 166
ERROR - 2020-04-29 22:31:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 166
ERROR - 2020-04-29 22:31:55 --> Severity: Notice --> Undefined variable: item C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 188
ERROR - 2020-04-29 22:31:55 --> Severity: Notice --> Undefined variable: id_maquina C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 200
ERROR - 2020-04-29 22:31:55 --> Severity: Notice --> Undefined variable: item C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 201
ERROR - 2020-04-29 22:33:01 --> Severity: Notice --> Undefined variable: id_maquina C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 97
ERROR - 2020-04-29 22:33:01 --> Severity: Notice --> Undefined variable: pontos C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 166
ERROR - 2020-04-29 22:33:01 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 166
ERROR - 2020-04-29 22:33:01 --> Severity: Notice --> Undefined variable: item C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 188
ERROR - 2020-04-29 22:33:01 --> Severity: Notice --> Undefined variable: id_maquina C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 200
ERROR - 2020-04-29 22:33:01 --> Severity: Notice --> Undefined variable: item C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 201
ERROR - 2020-04-29 22:34:31 --> Severity: Notice --> Undefined variable: id_maquina C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 97
ERROR - 2020-04-29 22:34:31 --> Severity: Notice --> Undefined variable: pontos C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 166
ERROR - 2020-04-29 22:34:31 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 166
ERROR - 2020-04-29 22:34:31 --> Severity: Notice --> Undefined variable: item C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 188
ERROR - 2020-04-29 22:34:31 --> Severity: Notice --> Undefined variable: id_maquina C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 200
ERROR - 2020-04-29 22:34:31 --> Severity: Notice --> Undefined variable: item C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 201
ERROR - 2020-04-29 22:35:57 --> Severity: Notice --> Undefined variable: id_maquina C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 97
ERROR - 2020-04-29 22:36:03 --> Severity: Notice --> Undefined offset: 44 C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_edit.php 99
ERROR - 2020-04-29 22:36:03 --> Severity: Notice --> Undefined offset: 44 C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_edit.php 105
ERROR - 2020-04-29 22:36:03 --> Severity: Notice --> Undefined offset: 43 C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_edit.php 99
ERROR - 2020-04-29 22:36:03 --> Severity: Notice --> Undefined offset: 43 C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_edit.php 105
ERROR - 2020-04-29 22:36:03 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_edit.php 123
ERROR - 2020-04-29 22:36:03 --> Severity: Notice --> Undefined variable: cheked_perfil C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_edit.php 127
ERROR - 2020-04-29 22:36:03 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_edit.php 127
ERROR - 2020-04-29 22:36:03 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_edit.php 127
ERROR - 2020-04-29 22:36:03 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_edit.php 123
ERROR - 2020-04-29 22:36:03 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_edit.php 127
ERROR - 2020-04-29 22:36:03 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_edit.php 127
ERROR - 2020-04-29 22:36:53 --> Severity: Notice --> Undefined offset: 44 C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_edit.php 99
ERROR - 2020-04-29 22:36:53 --> Severity: Notice --> Undefined offset: 44 C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_edit.php 105
ERROR - 2020-04-29 22:36:53 --> Severity: Notice --> Undefined offset: 43 C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_edit.php 99
ERROR - 2020-04-29 22:36:53 --> Severity: Notice --> Undefined offset: 43 C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_edit.php 105
ERROR - 2020-04-29 22:36:53 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_edit.php 123
ERROR - 2020-04-29 22:36:53 --> Severity: Notice --> Undefined variable: cheked_perfil C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_edit.php 127
ERROR - 2020-04-29 22:36:53 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_edit.php 127
ERROR - 2020-04-29 22:36:53 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_edit.php 127
ERROR - 2020-04-29 22:36:53 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_edit.php 123
ERROR - 2020-04-29 22:36:53 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_edit.php 127
ERROR - 2020-04-29 22:36:53 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_edit.php 127
ERROR - 2020-04-29 22:36:58 --> Severity: Notice --> Undefined variable: id_maquina C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 97
ERROR - 2020-04-29 22:37:04 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 146
ERROR - 2020-04-29 22:37:04 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 146
ERROR - 2020-04-29 22:37:04 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 146
ERROR - 2020-04-29 22:37:04 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 146
ERROR - 2020-04-29 22:39:40 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 146
ERROR - 2020-04-29 22:39:40 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 146
ERROR - 2020-04-29 22:39:40 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 146
ERROR - 2020-04-29 22:39:40 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 146
ERROR - 2020-04-29 22:39:54 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 146
ERROR - 2020-04-29 22:39:54 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 146
ERROR - 2020-04-29 22:39:54 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 146
ERROR - 2020-04-29 22:39:54 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 146
ERROR - 2020-04-29 23:20:27 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 146
ERROR - 2020-04-29 23:20:27 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 146
ERROR - 2020-04-29 23:20:27 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 146
ERROR - 2020-04-29 23:20:27 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 146
ERROR - 2020-04-29 23:26:20 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 148
ERROR - 2020-04-29 23:26:20 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 148
ERROR - 2020-04-29 23:26:20 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 148
ERROR - 2020-04-29 23:26:20 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 148
ERROR - 2020-04-29 23:27:13 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 148
ERROR - 2020-04-29 23:27:13 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 148
ERROR - 2020-04-29 23:27:13 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 148
ERROR - 2020-04-29 23:27:13 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 148
ERROR - 2020-04-29 23:27:17 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 148
ERROR - 2020-04-29 23:27:17 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 148
ERROR - 2020-04-29 23:27:17 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 148
ERROR - 2020-04-29 23:27:17 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 148
ERROR - 2020-04-29 23:28:08 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 148
ERROR - 2020-04-29 23:28:08 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 148
ERROR - 2020-04-29 23:28:08 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 148
ERROR - 2020-04-29 23:28:08 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 148
ERROR - 2020-04-29 23:28:25 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 148
ERROR - 2020-04-29 23:28:25 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 148
ERROR - 2020-04-29 23:28:25 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 148
ERROR - 2020-04-29 23:28:25 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 148
ERROR - 2020-04-29 23:28:35 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 148
ERROR - 2020-04-29 23:28:35 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 148
ERROR - 2020-04-29 23:28:35 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 148
ERROR - 2020-04-29 23:28:35 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 148
ERROR - 2020-04-29 23:29:32 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 146
ERROR - 2020-04-29 23:29:32 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 146
ERROR - 2020-04-29 23:29:32 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 146
ERROR - 2020-04-29 23:29:32 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 146
ERROR - 2020-04-29 23:29:32 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 165
ERROR - 2020-04-29 23:29:32 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 165
ERROR - 2020-04-29 23:29:32 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 165
ERROR - 2020-04-29 23:29:32 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 165
ERROR - 2020-04-29 23:30:28 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 147
ERROR - 2020-04-29 23:30:28 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 147
ERROR - 2020-04-29 23:30:28 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 147
ERROR - 2020-04-29 23:30:28 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 147
ERROR - 2020-04-29 23:30:28 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 167
ERROR - 2020-04-29 23:30:28 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 167
ERROR - 2020-04-29 23:30:28 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 167
ERROR - 2020-04-29 23:30:28 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 167
ERROR - 2020-04-29 23:31:02 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 147
ERROR - 2020-04-29 23:31:02 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 147
ERROR - 2020-04-29 23:31:02 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 147
ERROR - 2020-04-29 23:31:02 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 147
ERROR - 2020-04-29 23:31:02 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 167
ERROR - 2020-04-29 23:31:02 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 167
ERROR - 2020-04-29 23:31:02 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 167
ERROR - 2020-04-29 23:31:02 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 167
ERROR - 2020-04-29 23:31:43 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 147
ERROR - 2020-04-29 23:31:44 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 147
ERROR - 2020-04-29 23:31:44 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 147
ERROR - 2020-04-29 23:31:44 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 147
ERROR - 2020-04-29 23:31:44 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 167
ERROR - 2020-04-29 23:31:44 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 167
ERROR - 2020-04-29 23:31:44 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 167
ERROR - 2020-04-29 23:31:44 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 167
ERROR - 2020-04-29 23:33:34 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 147
ERROR - 2020-04-29 23:33:34 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 147
ERROR - 2020-04-29 23:33:34 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 147
ERROR - 2020-04-29 23:33:34 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 147
ERROR - 2020-04-29 23:33:34 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 167
ERROR - 2020-04-29 23:33:34 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 167
ERROR - 2020-04-29 23:33:34 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 167
ERROR - 2020-04-29 23:33:34 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 167
ERROR - 2020-04-29 23:33:55 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 147
ERROR - 2020-04-29 23:33:55 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 147
ERROR - 2020-04-29 23:33:55 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 147
ERROR - 2020-04-29 23:33:55 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 147
ERROR - 2020-04-29 23:33:55 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 167
ERROR - 2020-04-29 23:33:55 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 167
ERROR - 2020-04-29 23:33:55 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 167
ERROR - 2020-04-29 23:33:55 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 167
ERROR - 2020-04-29 23:36:01 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 147
ERROR - 2020-04-29 23:36:01 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 147
ERROR - 2020-04-29 23:36:01 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 147
ERROR - 2020-04-29 23:36:01 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 147
ERROR - 2020-04-29 23:36:01 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 167
ERROR - 2020-04-29 23:36:01 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 167
ERROR - 2020-04-29 23:36:01 --> Severity: Warning --> Use of undefined constant id - assumed 'id' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 167
ERROR - 2020-04-29 23:36:01 --> Severity: Warning --> Use of undefined constant nome - assumed 'nome' (this will throw an Error in a future version of PHP) C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_add.php 167
ERROR - 2020-04-29 23:36:06 --> Severity: Notice --> Undefined variable: id_maquina C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 97
ERROR - 2020-04-29 23:36:55 --> Severity: Notice --> Undefined variable: id_maquina C:\xampp\htdocs\altechindustria\vm\application\views\admin\users\user_list_maquinas.php 98
