<html>
<?php
	require 'menu.php';
?>
	<center>
		<form method="post" action="paciente_insert.php">
			<frameset>
				<legend>Cadastro de Paciente</legend>
				<p>
					<select name="tipo_documento">
						<option value="" hidden>Selecione o Tipo de Documento</option>
						<option value="RG">RG</option>
						<option value="CPF">CPF</option>
						<option value="Passaporte">Passaporte</option>
					</select>
				</p>
				<p>
					<input name="documento" type="text" placeholder="Número do Documento" />
				</p>
				<p>
					<input name="nome" type="text" placeholder="Nome" />
				</p>
				<p>
					<select name="sexo">
						<option value="" hidden>Sexo</option>
						<option value="M">Masculino</option>
						<option value="F">Feminino</option>
						<option value="I">Não Informado</option>
					</select>
				</p>
				<p>
					<input name="nascimento" type="text" placeholder="Data de Nascimento" onFocus="this.type='date';" />
				</p>
				<p>
					<input name="email" type="text" placeholder="e-mail" />
				</p>
				<p>
					<input name="fone" type="text" placeholder="Telefone" />
				</p>
				<p>
					<input name="moradia" type="text" placeholder="Moradia" />
				</p>
				<p>
					<input name="copia" type="text" placeholder="Cópia Documento" onFocus="this.type='file';" />
				</p>
				<p>
					<input type="submit" value="Confirmar" />
					<input type="reset" value="Cancelar" />
				</p>
			</frameset>
		</form>
		</center>
	</body>
</html>