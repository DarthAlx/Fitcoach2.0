@extends('plantilla')
@section('pagecontent')
	<section class="container">
		<div class="topclear">
	    &nbsp;
	  </div>
		<div class="container-bootstrap">
			<div class="row">
				@include('holders.notificaciones')
			</div>
		</div>

		<div class="container-bootstrap-fluid">
			<div class="row">
				<div class="col-sm-3">
					<h4 style="margin-top: 0px;"><strong><a href="#" onclick="legales('terminos');">Términos & condiciones</a></strong></h4>
					<p>&nbsp;</p>
					<h4><strong><a href="#" onclick="legales('privacidad');">Políticas de Privacidad</a></strong></h4>
				</div>
				<div class="col-sm-9">
					<div id="privacidad" style="text-align: justify;">
						<h2 style="margin-top:0px;">AVISO DE PRIVACIDAD</h2>
						<p>FITCOACH MEXICO S.A. DE C.V., mejor conocido como FITCOACH México, con domicilio en Av. de las Plazas 60 Sayabes Torre 1302 Piso 13, Col. Bosque Real, Huixquilucan, Estado de México, C.P. 52774, México, y portal de internet www.fitcoach.mx, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente:</p>

						<h4><strong>¿Para qué fines utilizaremos sus datos personales?</strong></h4>
						<p>Los datos personales que recabamos de usted, los utilizaremos para las siguientes finalidades que son necesarias para el servicio que solicita:</p>
						<p>
							<ul>
								<li>Prestar los servicio contratados (actividades, eventos y/u otros cargos)</li>
								<li>Generar estados de cuenta</li>
								<li>Domiciliación</li>
								<li>Generar matrícula de cliente para procesos administrativos internos</li>
							</ul>
						</p>
						<p>De manera adicional, utilizaremos su información personal para las siguientes finalidades secundarias que no son necesarias para el servicio solicitado, pero que nos permiten y facilitan brindarle una mejor atención:</p>
						<p>
							<ul>
								<li>Mercadotecnia o publicitaria</li>
								<li>Prospección comercial</li>
							</ul>
						</p>
						<p>En caso de que no desee que sus datos personales sean tratados para estos fines secundarios, desde este momento usted nos puede comunicar lo anterior enviando un correo a info@fitcoach.mx.

La negativa para el uso de sus datos personales para estas finalidades no podrá ser un motivo para que le neguemos los servicios y productos que solicita o contrata con nosotros.
</p>
						<h4><strong>¿Qué datos personales utilizaremos para estos fines?</strong></h4>
						<p>Para llevar a cabo las finalidades descritas en el presente aviso de privacidad, utilizaremos los siguientes datos personales:</p>
						<ul>
							<li>Datos de identificación</li>
							<li>Datos de contacto</li>
							<li>Datos sobre características físicas</li>
						</ul>
						<p>Además de los datos personales mencionados anteriormente, para las finalidades informadas en el presente aviso de privacidad utilizaremos los siguientes datos personales considerados como sensibles, que requieren de especial protección:</p>
						<ul>
							<li>Datos de salud</li>
						</ul>
						<h4><strong>¿Cómo puede acceder, rectificar o cancelar sus datos personales, u oponerse a su uso?</strong></h4>
						<p>Usted tiene derecho a conocer qué datos personales tenemos de usted, para qué los utilizamos y las condiciones del uso que les damos (Acceso). Asimismo, es su derecho solicitar la corrección de su información personal en caso de que esté desactualizada, sea inexacta o incompleta (Rectificación); que la eliminemos de nuestros registros o bases de datos cuando considere que la misma no está siendo utilizada adecuadamente (Cancelación); así como oponerse al uso de sus datos personales para fines específicos (Oposición). Estos derechos se conocen como derechos ARCO.</p>
						<p>Para el ejercicio de cualquiera de los derechos ARCO, usted deberá presentar la solicitud respectiva a través de correo electrónico.</p>
						<p>Con relación al procedimiento y requisitos para el ejercicio de sus derechos ARCO, le informamos lo siguiente:</p>
						<ol>
							<li>¿A través de qué medios pueden acreditar su identidad el titular y, en su caso, su representante, así como la personalidad este último?
<br>Enviando un correo a info@fitcoach.mx</li>
							<li>¿Qué información y/o documentación deberá contener la solicitud?
<br>
Nombre, dirección, correo electrónico e identificación oficial</li>
<li>¿En cuántos días le daremos respuesta a su solicitud?
<br>
5 días hábiles</li>
<li>¿Por qué medio le comunicaremos la respuesta a su solicitud?
<br>
Correo electrónico</li>
<li>¿En qué medios se pueden reproducir los datos personales que, en su caso, solicite?
<br>
Correo electrónico</li>
						</ol>
						<p>Los datos de contacto de la persona o departamento de datos personales, que está a cargo de dar trámite a las solicitudes de derechos ARCO, son los siguientes:</p>
						<ol>
							<li>Nombre de la persona o departamento de datos personales:
<br>
Atención a Clientes</li>
							<li>Domicilio:
<br>
Av. de las Plazas 60 Sayabes Torre 1302 Piso 13, Col. Bosque Real, Huixquilucan, Estado de México, C.P. 52774, México.</li>
							<li>Correo electrónico:
<br>
info@fitcoach.mx</li>
							<li>Número telefónico:
<br>
5528820141</li>
						</ol>
						<h4><strong>Usted puede revocar su consentimiento para el uso de sus datos personales</strong></h4>
						<p>Usted puede revocar el consentimiento que, en su caso, nos haya otorgado para el tratamiento de sus datos personales. Sin embargo, es importante que tenga en cuenta que no en todos los casos podremos atender su solicitud o concluir el uso de forma inmediata, ya que es posible que por alguna obligación legal requiramos seguir tratando sus datos personales. Asimismo, usted deberá considerar que para ciertos fines, la revocación de su consentimiento implicará que no le podamos seguir prestando el servicio que nos solicitó, o la conclusión de su relación con nosotros.</p>
						<p>Para revocar su consentimiento deberá presentar su solicitud a través de correo electrónico.</p>
						<p>Con relación al procedimiento y requisitos para la revocación de su consentimiento, le informamos lo siguiente:</p>
						<ol>
							<li>¿A través de qué medios pueden acreditar su identidad el titular y, en su caso, su representante, así como la personalidad este último?
<br>
Correo electrónico</li>
							<li>¿Qué información y/o documentación deberá contener la solicitud?
<br>
Nombre, dirección, correo electrónico e identificación oficial</li>
							<li>¿En cuántos días le daremos respuesta a su solicitud?
<br>
5 días hábiles</li>
							<li>¿Por qué medio le comunicaremos la respuesta a su solicitud?
<br>
Correo electrónico</li>
						</ol>
						<h4><strong>¿Cómo puede limitar el uso o divulgación de su información personal?</strong></h4>
						<p>Con objeto de que usted pueda limitar el uso y divulgación de su información personal, le ofrecemos los siguientes medios: enviando un correo a info@fitcoach.mx</p>
						<h4><strong>El uso de tecnologías de rastreo en nuestro portal de internet</strong></h4>
						<p>Le informamos que en nuestra página de internet utilizamos cookies, web beacons u otras tecnologías, a través de las cuales es posible monitorear su comportamiento como usuario de internet, así como brindarle un mejor servicio y experiencia al navegar en nuestra página. Los datos personales que recabamos a través de estas tecnologías, los utilizaremos para estadísticas internas.
<br>
Los datos personales que obtenemos de estas tecnologías de rastreo son los siguientes:</p>
<ol>
	<li>Identificadores, nombre de usuario y contraseñas de una sesión</li>
	<li>Región en la que se encuentra el usuario</li>
	<li>Tipo de navegador del usuario</li>
	<li>Tipo de sistema operativo del usuario</li>
	<li>Fecha y hora del inicio y final de una sesión de un usuario</li>
</ol>
<h4><strong>¿Cómo puede conocer los cambios en este aviso de privacidad?</strong></h4>
<p>El presente aviso de privacidad puede sufrir modificaciones, cambios o actualizaciones derivadas de nuevos requerimientos legales; de nuestras propias necesidades por los productos o servicios que ofrecemos; de nuestras prácticas de privacidad; de cambios en nuestro modelo de negocio, o por otras causas. Nuestro aviso de privacidad más actualizado siempre estará disponible para usted en www.fitcoach.com/aviso</p>
<p>&nbsp;</p>
<p class="text-right">Última actualización: 08/06/2017</p>

					</div>
					<div id="terminos" style="text-align: justify;">
						<h2 style="margin-top:0px;">TÉRMINOS Y CONDICIONES</h2>
						<p>FITCOACH MEXICO S.A. de C.V. (en adelante “FITCOACH”, “Compañía”, “Nosotros”, o “Nuestro”), se complace en poner a su disposición los Servicios que
        ofrece, según dicho término se define a continuación, de conformidad con los siguientes Términos y Condiciones que regulan el uso de (i) fitcoach.mx
        (en adelante el “Sitio Web”), independientemente de los medios de acceso a él, tales como computadoras o dispositivos móviles (teléfonos inteligentes
        y tabletas); (ii) el contenido de FITCOACH que aparezca en los sitios web de terceros y redes sociales y (iii) los Servicios que sean contratados
        con Nosotros por el cliente.</p>
    <p>Estos Términos y Condiciones constituyen un acuerdo vinculante entre usted y FITCOACH y se consideran aceptados por su parte cada vez que usted acceda
        a el Sitio Web o solicite cualquiera de los Servicios ofrecidos por Nosotros, en la versión publicada por la Compañía en el momento mismo en que
        usted acceda a el Sitio Web. Cualquier modificación a los presentes Términos y Condiciones será realizada por FITCOACH, cuando así lo considera
        apropiado, siendo exclusiva responsabilidad del Usuario asegurarse de tomar conocimiento de tales modificaciones.</p>
    <p>FITCOACH es una compañía que facilita el contacto entre personas que requieren servicios deportivos, culturales y/o recreativos (los “Servicios”),
        las personas que ofrecen dichos Servicios y la contratación de dichos Servicios entre ellos. FITCOACH funge exclusivamente como un enlace o intermediario
        y en ningún momento deberá ser considerada como una empresa que presta servicios deportivos, culturales y/o recreativos.</p>
    <h4><strong>I. Reglas Generales de Uso</strong></h4>
    <p>a. (i) La información, consejos, conceptos y opiniones publicadas en el Sitio Web no necesariamente reflejan la posición de FITCOACH ni de sus empleados,
        directores o accionistas. Por lo anterior, FITCOACH no se hace responsable por la información, consejos y opiniones que se emitan en el Sitio Web.</p>
    <p>b. FITCOACH se reserva el derecho de bloquear el acceso o remover en forma parcial o total, toda información, comunicación o material que a su exclusivo
        juicio pueda resultar: (i) abusivo, difamatorio, obsceno, ofensivo (ii) fraudulento, artificioso o engañoso, (iii) violatorio de derechos de autor,
        marcas, confidencialidad, secretos industriales o cualquier derecho de propiedad intelectual de un tercero, o (iv) de cualquier forma contravenga
        lo establecido en los presentes Términos y Condiciones.</p>
    <h4><strong>II. Funcionamiento y Solicitud del Servicio</strong></h4>
    <p>FITCOACH es una compañía dedicada a conectar a personas que buscan servicios deportivos, culturales y/o recreativos (cada uno un “Cliente”) y prestadores
        de servicios independientes</p>
    <p>que forman parte de la red de FITCOACH (cada uno un “COACH” (en plural “COACHES”), y de manera conjunta con el Cliente los “Usuarios”) que pueden estar
        disponibles para realizar el servicio. La Compañía revisa los antecedentes de cada COACH; sin embargo, la Compañía no garantiza ni garantizará,
        hace o hará ningún tipo de representación con respecto a la fiabilidad, la calidad o idoneidad de dichos proveedores de servicios. La compañía
        no será responsable de la conducta de cualquier COACH o Cliente de la Compañía.</p>
    <h4><strong>Funcionamiento</strong></h4>
    <p>a) Usted, el Cliente solicita los Servicios por medio del Sitio Web o llamada telefónica. Para ello deberá proporcionar datos fidedignos del lugar
        en donde se prestarán los Servicios, así como sus datos personales para identificarlo, y los datos de pago para que FITCOACH proceda al cobro del
        servicio por parte del COACH.</p>
    <p>b) FITCOACH trasmitirá los datos personales y la ubicación del Cliente a su red de COACHES para realizar el servicio, así como cualquier solicitud
        especial o comentario hecho por el Cliente.</p>
    <p>c) FITCOACH confirmará el servicio y proporcionará al Cliente los datos de identificación del COACH.</p>
    <p>d) El COACH se presentará en el domicilio y hora indicada por el Cliente. Cualquier cambio de día, hora y/o domicilio deberá ser notificado por el
        Cliente a través de el Sitio Web o llamada telefónica cuando menos con 24 horas de anticipación al Servicio originalmente programado.</p>
    <p>e) El Cliente podrá proporcionar a la Compañía retroalimentación sobre el Servicio, incluyendo faltas o errores en relación con dicho servicio. Esta
        información podrá ser utilizada por FITCOACH para mejorar y perfeccionar los Servicios, en este sentido, los Usuarios otorgan a la compañía el
        uso no exclusivo e irrevocable libre de regalías para usar, reproducir, divulgar, distribuir, modificar y explotar dichos comentarios sin restricción
        alguna.</p>
    <h4><strong>Cancelación del Servicio</strong></h4>
    <p>Si el Cliente desea cancelar el Servicio programado, se requiere un aviso de cancelación con al menos 24 horas de anticipación al servicio originalmente
        programado. La notificación deberá ser hecha a través de un correo electrónico dirigido a contacto@fitcoach.mx. En caso que el Cliente no cancele
        el servicio y este no pueda ser prestado por causas ajenas al COACH o a Nosotros, se cobrará la totalidad de las horas reservadas.</p>
    <h4><strong>Reposición de Clases</strong></h4>
    <p>La reposición de un Servicio se llevará acabo dependiendo de la causa por la cuál no se pudo prestar de acuerdo a los siguientes puntos:</p>
    <p>a) Si el Servicio no pudo ser llevado a cabo por inasistencia del profesor, la clase podrá ser reprogramada para otra fecha en la cual el COACH esté
        disponible sin ningún cargo extra para el Cliente.</p>
    <p>b) Si el servicio no pudo ser iniciado por situaciones climáticas, la clase podrá ser reprogramada para otra fecha en el cuál el COACH esté disponible
        siempre y cuando el Cliente se haya presentado. En el caso de Servicios grupales, tendrá que haber asistencia de la mayoría del grupo para su reposición.</p>
    <p>c) Si el servicio no pudo ser llevado a cabo por situaciones de causa mayor, la clase no podrá ser reprogramada bajo ninguna circunstancia.</p>
    <h4><strong>Días Festivos</strong></h4>
    <p>La prestación de un Servicio en días festivos dependerá de la disponibilidad del COACH. Estos espacios se irán liberando en el Sitio Web conforme los
        COACHES confirmen su disponibilidad. El Cliente será notificado mínimo 24 horas antes de el Servicio.</p>
    <h4><strong>III. Obligaciones de los Clientes</strong></h4>
    <p>Las obligaciones del Cliente, son las que se listan a continuación de manera enunciativa pero no limitativa: (i) cubrir el costo del Servicio, (ii)
        proveer datos verídicos como, nombre, datos de contacto y ubicación donde se llevará a cabo el Servicio así como la existencia de cualquier preferencia
        o especificación para que el COACH pueda llevar a cabo el Servicio de manera puntual y eficiente, (iii) sacar en paz y a salvo al COACH en caso
        de incumplir con los términos de servicio e indemnizar a FITCOACH por cualquier acción legal que resulte en su contra, (iv) tener disponibles los
        espacios necesarios para la correcta prestación del Servicio, (v) contar con la computadora o dispositivo móvil que cumplan con las características
        y requisitos técnicos para acceder y utilizar el Sitio Web, incluyendo la conexión a internet, o capacidad para realizar llamadas, (vi) preservar
        de manera confidencial los datos del COACH y no revelarlos ni darles tratamiento no autorizado por el COACH, y (vii) no utilizar el Sitio Web para
        exhibir, transmitir, distribuir o vincular cualquier material que sea falso o engañoso, discriminatorio, difamatorio, ofensivo u obsceno o que
        pueda incitar a discriminación, odio o violencia contra una persona o grupo de personas a causa de su origen o pertenencia a un grupo étnico, raza
        o religión, a causa de su género o orientación sexual, (viii) asumir todo el riesgo y responsabilidad por el incumplimiento de estas obligaciones.</p>
    <h4><strong>IV. Cambio de COACHES</strong></h4>
    <p>FITCOACH se reserva el derecho de cambiar en cualquier momento que considere oportuno al COACH que esté impartiendo un Servicio sin la obligación de
        dar al Cliente las razones de dicho cambio. La compañía se compromete a enviar un remplazo para brindar el Servicio al Cliente reponiendo cualquier
        Servicio que no pueda ser brindado por razones relacionadas a la acción expresada anteriormente.</p>
    <h4><strong>V. Derecho de Autor</strong></h4>
    <p>FITCOACH sus logotipos y todo el material que aparece en el Sitio Web, son marcas, nombres de dominio y nombres comerciales propiedad de FITCOACH protegidos
        por leyes federales en</p>
    <p>materia de propiedad intelectual y derechos de autor. Los derechos de autor sobre el contenido, organización, recopilación, información, logotipos,
        fotografías, imágenes, videos, programas, aplicaciones, o en general cualquier información contenida o publicada en el Sitio Web se encuentra debidamente
        protegida en conformidad con la legislación aplicable en materia de propiedad intelectual.</p>
    <p>Se prohíbe expresamente al Usuario a modificar, alterar o suprimir, ya sea en forma total o parcial, los avisos, marcas, nombres comerciales, señas,
        anuncios, logotipos o en general cualquier indicación que se refiere a la propiedad de información contenida en el Sitio Web. El Usuario se obliga
        a no modificar, reproducir, copiar, rediseñar, descompilar, adaptar, traducir, preparar trabajos derivados del Sitio Web para desarrollar cualquier
        software u otros materiales basados en los mismos.</p>
    <h4><strong>VI. Condiciones del Pago</strong></h4>
    <p>Cualquier cargo hecho por la Compañía será exigible al momento de contratación del Servicio y no será reembolsable. Esta Política de no reembolso será
        aplicable en todo momento, independientemente de su decisión de suspender el uso del Sitio Web o el Servicio. En caso de que el Cliente no esté
        conforme con los Servicio realizados podrá contactar al personal de FITCOACH quién podrá ofrecerle asistencia a través de los teléfonos que para
        tal efecto de tiempo en tiempo se publiquen en el Sitio Web.</p>
    <p>La Compañía podrá, discrecionalmente, hacer ofertas o promocionales con diferentes características y diferentes tasas a cualquiera de los Clientes.
        Estas ofertas o promocionales, a menos que se le haga a Usted, no tendrá validez alguna. FITCOACH puede cambiar los precios por el Servicio cuando
        lo considere necesario. Sugerimos revisar periódicamente en el Sitio Web con el fin de revisar el precio de los Servicios y cualquier modificación
        que los mismos pudieren sufrir.</p>
    <h4><strong>VII. Deslinde de Responsabilidad</strong></h4>
    <p>El Usuario está de acuerdo que el uso del Sitio Web o de Nuestros Servicios se realiza bajo su propio riesgo. La Compañía no hace ningún tipo de representación
        ni otorga ningún tipo de garantía en cuanto a la confiabilidad, puntualidad, calidad, idoneidad, disponibilidad, exactitud o totalidad de los Servicios
        o del Sitio Web. FITCOACH no garantiza que (i) el uso del Servicio será seguro, oportuno, ininterrumpido o libre de errores (ii) que el Servicio
        o el software del Sitio Web cumplirá con sus necesidades o expectativas, (iii) que la calidad de cualquier producto, Servicio, información u otro
        material obtenido por usted a través del Sitio Web, llamada telefónica o Servicio (incluyendo cualquier servicio deportivo, cultural y/o recreativo)
        cumplirá al cien por ciento los requerimientos del Cliente, sus necesidades o expectativas, (iv) que el Sitio Web esté libres de virus u otros
        componentes dañinos. El Software del Sitio Web, así como los Servicio que se ofrecen en FITCOACH se prevén sobre una base “Tal Cual” y “Según sean
        disponibles”.</p>
    <p>FITCOACH no asume responsabilidad alguna por cualquier lesión que pudiera derivarse de la actividad física realizada por el Usuario, así como por los
        daños y perjuicios de cualquier naturaleza que pudieran derivarse de la utilización de los Servicios y de los contenidos por parte de los Usuarios
        que puedan derivarse de la falta de veracidad, exhaustividad o autenticidad de la información que los Usuarios proporcionan, incluyendo pero no
        limitado a los daños y perjuicios que puedan derivarse de la suplantación de la personalidad de un tercero efectuada por un usuario en cualquier
        clase de comunicación realizada a través del Sitio Web o llamada telefónica.</p>
    <p>FITCOACH no asume ningún tipo de responsabilidad por los servicios prestados por proveedores independientes y ajenos a FITCOACH. Así mismo, FITCOACH
        no será responsable, bajo ninguna circunstancia de cualquier daño o perjuicio, directo o indirecto, causado en virtud de los Servicios contratados
        y facilitados a través del Sitio Web o llamada telefónica.</p>
    <h4><strong>VIII. Modificación a los presentes Términos y Condiciones</strong></h4>
    <p>FITCOACH se reserva el derecho de modificar en cualquier momento que considere oportuno el contenido de estos Términos y Condiciones pudiendo adicionar
        provisiones relativas a áreas específicas o nuevos Servicios que en un futuro FITCOACH proporcione a través del Sitio Web o de llamadas telefónicas,
        los cuales serán publicadas en el Sitio Web para su lectura. Dichas modificaciones formarán parte integrante del presente contrato para todos los
        efectos legales a que haya lugar. Es responsabilidad de los Usuarios verificar de tiempo en tiempo los presentes Términos y Condiciones para verificar
        el contenido de los mismos incluyendo cualquier cambio o modificación.</p>
    <h4><strong>IX. Indemnización</strong></h4>
    <p>Al hacer uso del Sitio Web y Servicios de FITCOACH, el Usuario consiente en indemnizar a FITCOACH, sus COACHES, accionistas, proveedores, vendedores
        y asesores de cualquier acción, demanda o reclamación (incluyendo honorarios de abogados y costas judiciales) derivadas de cualquier incumplimiento
        al presente Contrato por parte del Usuario.</p>
    <h4><strong>X. Limitación de Responsabilidad</strong></h4>
    <p>FITCOACH no será responsable frente a Usted ni frente a terceros por la no prestación de un Servicio pactado por un COACH de manera externa a la compañía.
        En ningún caso y bajo ninguna circunstancia, FITCOACH, sus directores, empleados, agentes o accionistas serán responsables por los daños o perjuicios
        de cualquier tipo que surjan o se de alguna manera se relacionen con el uso o imposibilidad de usar el Servicio o el Sitio Web, incluyendo sin
        limitación los daños provocados por la confianza depositada en el Usuario en cualquier información obtenida de FITCOACH, o como resultado de errores,
        omisiones, interrupciones, eliminación de archivos o correo electrónico, errores, defectos, virus, retrasos en la operación o transmisión o cualquier
        fallo de funcionamiento, sea éste ocasionado por desastres naturales, fallo de</p>
    <p>comunicaciones, robo, destrucción o acceso no autorizado a los registros de la Compañía. En ningún caso, la responsabilidad de FITCOACH, derivada de
        un contrato, garantía, responsabilidad objetiva o de otro tipo, que surja en relación con el uso o imposibilidad de uso de los Servicios podrá
        superar la compensación que se pague en su caso a FITCOACH por el acceso o el uso de los Servicios.</p>
    <h4><strong>XI. Legislación Aplicable y Jurisdicción</strong></h4>
    <p>El presente Contrato se regirá e interpretará de conformidad con las leyes de México, independientemente de las disposiciones relacionadas con conflictos
        de leyes. Cualquier procedimiento de carácter legal que se derive o se relacione con este Contrato será dirimido en los tribunales competentes
        de la Ciudad de México. Las partes del presente Contrato expresamente renuncian a cualquier otra jurisdicción que pudiera corresponderles en razón
        de su domicilio presente o futuro o por cualquier otra razón.</p>
					</div>
				</div>
			</div>
		</div>
		<p>&nbsp;</p>

<script type="text/javascript">
	function legales(valor){
		$('#privacidad').fadeOut();
		$('#terminos').fadeOut();
		$('#'+valor).fadeIn();
	}

</script>
	</section>
@endsection
