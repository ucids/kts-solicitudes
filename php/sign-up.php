<?php
// require $_SERVER['DOCUMENT_ROOT'] . '/functions/profile/session.php';
require 'functions/profile/session.php';
if ($rol == 1 || $rol == 2 || $rol == 3) {
    // El rol es 1, 2 o 3, permitir acceso a la página actual
} else {
    // Redirigir al usuario al index.php
    header("Location: index.php");
    exit();
}
require 'class/data.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $username = explode('@', $email)[0];
    $nombre = $_POST['first-name'];
	$apellidos = $_POST['last-name'];
	$rol = $_POST['rol'];
	$departamento = $_POST['departamento'];
    $supervisor = $_POST['supervisor'];
	$supervisorArray = json_decode($supervisor, true);
	$valuesArray = array_column($supervisorArray, 'value');
	$scope = str_replace('"', '', json_encode($valuesArray));
    // Check if username or email already exists
    $stmt = $conn->prepare('SELECT COUNT(*) AS count FROM users WHERE username = :username OR email = :email');
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
      $message = 'EL usuario ya ha sido registrado';
    } else {
      // Insert new user
      $sql = "INSERT INTO users (email, password, username, nombre, apellidos, fk_rol, fk_departamento,	 scope) VALUES (:email, :password, :username, :nombre, :apellidos, :rol, :departamento, :scope)";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':username', $username);
	  $stmt->bindParam(':nombre', $nombre);
      $stmt->bindParam(':apellidos', $apellidos);
      $stmt->bindParam(':rol', $rol);
      $stmt->bindParam(':departamento', $departamento);
      $stmt->bindParam(':scope', $scope);

      $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
      $stmt->bindParam(':password', $password);

      if ($stmt->execute()) {
        $message = 'Usuario Creado exitosamente.';
      } else {
        $message = 'Sorry there must have been an issue creating your account';
      }
    }

    // Redirect to the same page with the message
    header("Location: ".$_SERVER['PHP_SELF']."?message=" . urlencode($message));
    exit();
  }
}

// Retrieve the message from the URL parameter if available
$message = isset($_GET['message']) ? $_GET['message'] : '';
if ($message == 'Usuario Creado exitosamente.'){
	$color = 'success';
	$icon ='<i class="bi bi-check-circle-fill fs-5x text-success"></i>';
}else{
	$color = 'danger';
	$icon ='<i class="bi bi-x-circle-fill fs-5x text-danger"></i>';
}

?>

<!DOCTYPE html>

<html lang="es">
	<!--begin::Head-->
	<head><base href="../../../">
		<title>Katzkin Compras</title>
		<meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta charset="utf-8" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
		<meta property="og:url" content="https://ucid.com" />
		<meta property="og:site_name" content="Keenthemes | Metronic" />
		<link rel="canonical" href="https://ucid.com" />
		<link rel="shortcut icon" href="/view/assets/media/logos/katzkin.png" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="/view/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/view/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/view/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>

		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="bg-body">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-up -->
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(/view/assets/media/illustrations/sigma-1/14.png">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<!--begin::Logo-->
					<a href="index.php" class="mb-12">
						<img alt="Logo" src="/view/assets/media/logos/logo-ktz.png" class="h-100px" />
					</a>
					<!--end::Logo-->
					<!--begin::Wrapper-->
					<div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
						<!--begin::Form-->
						<?php if(!empty($message)): ?>
							<!--begin::Alert-->
							<div class="alert alert-dismissible bg-light-<?php echo $color; ?> d-flex flex-center flex-column py-10 px-10 px-lg-20 mb-10">
								<!--begin::Close-->
								<button type="button" class="position-absolute top-0 end-0 m-2 btn btn-icon btn-icon-<?php echo $color; ?>" data-bs-dismiss="alert">
									<span class="svg-icon svg-icon-1"><i class="bi bi-x-circle fs-2qx"></i></span>
								</button>
								<!--end::Close-->

								<!--begin::Icon-->
								<span class="svg-icon svg-icon-5tx svg-icon-<?php echo $color; ?> mb-5"><?php echo $icon;?></span>
								<!--end::Icon-->

								<!--begin::Wrapper-->
								<div class="text-center">
									<!--begin::Title-->
									<!-- <h1 class="fw-bolder mb-5"><?php echo $message; ?></h1> -->
									<!--end::Title-->

									<!--begin::Separator-->
									<div class="separator separator-dashed border-<?php echo $color; ?> opacity-25 mb-5"></div>
									<!--end::Separator-->

									<!--begin::Content-->
									<div class="mb-9 text-dark">
										<strong><?php echo $message; ?></strong>.<br/>
										<!-- Please read our <a href="#" class="fw-bolder me-1">Terms and Conditions</a> for more info. -->
									</div>
									<!--end::Content-->

									<!--begin::Buttons-->
									<div class="d-flex flex-center flex-wrap">
										<!-- <a href="#" class="btn btn-outline btn-outline-success btn-active-success m-2">Cancel</a> -->
										<a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-primary m-2">Ok</a>
									</div>
									<!--end::Buttons-->
								</div>
								<!--end::Wrapper-->
							</div>
							<!--end::Alert-->
						<?php endif; ?>
						<form action="sign-up.php" method="POST" class="form w-100 needs-validation">
							<!--begin::Heading-->
							<div class="mb-10 text-center">
								<!--begin::Title-->
								<h1 class="text-danger mb-3 ">Dar de alta a	 un usuario</h1>
								<!--end::Title-->
								<!--begin::Link-->
								<div class="text-gray-400 fw-bold fs-4" >O ve a
								<a href="index.php" class="link-primary fw-bolder">Inicio</a></div> 
								<!--end::Link-->
							</div>
							<!--end::Heading-->
							<!--begin::Separator-->
							<div class="d-flex align-items-center mb-10">
								<div class="border-bottom border-gray-300 mw-50 w-100"></div>
								<span class="fw-bold text-gray-400 fs-7 mx-2">OR</span>
								<div class="border-bottom border-gray-300 mw-50 w-100"></div>
							</div>
							<!--end::Separator-->
							<!--begin::Input group-->
							<div class="row fv-row mb-7">
								<!--begin::Col-->
								<div class="col-xl-6">
									<label  for="validationServerUsername" class="required form-label fw-bolder text-dark fs-6">Nombre(s)</label>
									<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="first-name" autocomplete="off" required="true"/>
								</div>
								<!--end::Col-->
								<!--begin::Col-->
								<div class="col-xl-6">
									<label  class="required form-label fw-bolder text-dark fs-6">Apellido</label>
									<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="last-name" autocomplete="off" required="true"/>
								</div>
								<!--end::Col-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->

							<div class="fv-row mb-7">
								<?php
									// $stmt = $conn->prepare('SELECT id_rol, descripcion FROM roles');
									if ($rol == 1) {
										$stmt = $conn->prepare('SELECT id_rol, descripcion FROM roles');
									} else {
										$stmt = $conn->prepare('SELECT id_rol, descripcion FROM roles WHERE id_rol IN (4, 5, 6)');
									}
									
									$stmt->execute();
									$roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
									$options = '';
									foreach ($roles as $role) {
										$roleID = $role['id_rol'];
										$roleName = $role['descripcion'];
										$options .= '<option value="' . $roleID . '">' . $roleName . '</option>';
									}
								?>
								<label class=" required form-label fw-bolder text-dark fs-6">Puesto</label>
								<select name="rol" class="form-select form-select-solid" aria-label="Select example" required="true">
									<option value="">Selecciona el Puesto</option>
									<?php echo $options; ?>
								</select>
							</div>
							
							<div class="fv-row mb-7">
								<?php
									$stmt_dep = $conn->prepare('SELECT id_departamento, departamento FROM departamento');
									$stmt_dep->execute();
									$departamentos = $stmt_dep->fetchAll(PDO::FETCH_ASSOC);
									$option_dep = '';
									$selector_dep = '';
									foreach ($departamentos as $role_dep) {
										$role_depID = $role_dep['id_departamento'];
										$role_depName = $role_dep['departamento'];
										$option_dep .= '<option value="' . $role_depID . '">' . $role_depName . '</option>';
										$selector_dep .= '<div class="d-flex align-items-center mb-8">
										<!--begin::Bullet-->
										<span class="bullet bullet-vertical h-40px bg-success"></span>
										<!--end::Bullet-->
										<!--begin::Checkbox-->
										<div class="form-check form-check-custom form-check-solid mx-5">
											<input class="form-check-input" type="checkbox" value="">
										</div>
										<!--end::Checkbox-->
										<!--begin::Description-->
										<div class="flex-grow-1">
											<a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Create FireStone Logo</a>
											<span class="text-muted fw-bold d-block">Due in 2 Days</span>
										</div>
										<!--end::Description-->
										<span class="badge badge-light-success fs-8 fw-bolder">New</span>
									</div>';
									}
								?>
								<label class=" required form-label fw-bolder text-dark fs-6">Departamento</label>
								<select name="departamento" class="form-select form-select-solid" aria-label="Select example" required="true">
									<option value="">Selecciona el Departamento</option>
									<?php echo $option_dep; ?>
								</select>
							</div>

							<!--!! AREAS DE RESPONSABILIDAD -->
							<label class=" required form-label fw-bolder text-dark fs-6">Areas Asignadas</label>
							<input class="form-control  form-control-lg d-flex align-items-center" value="" id="kt_tagify_users" name ="supervisor"/>
							<br>
							<div class="fv-row mb-7">
								<label class="required form-label fw-bolder text-dark fs-6">Email</label>
								<input class="form-control form-control-lg form-control-solid" type="email" placeholder="" name="email" autocomplete="off" required="true"/>
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="mb-10 fv-row" data-kt-password-meter="true">
								<!--begin::Wrapper-->
								<div class="mb-1">
									<!--begin::Label-->
									<label class="required form-label fw-bolder text-dark fs-6">Contraseña</label>
									<!--end::Label-->
									<!--begin::Input wrapper-->
									<div class="position-relative mb-3">
										<input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="password" autocomplete="off" required="true"/>
										<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
											<i class="bi bi-eye-slash fs-2"></i>
											<i class="bi bi-eye fs-2 d-none"></i>
										</span>
									</div>
									<!--end::Input wrapper-->
									<!--begin::Meter-->
									<div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
										<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
										<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
										<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
										<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
									</div>
									<!--end::Meter-->
								</div>
								<!--end::Wrapper-->
								<!--begin::Hint-->
								<div class="text-muted">Usa 8 digitos mezclados con numeros, maysuculas y minusculas</div>
								<!--end::Hint-->
							</div>

							<div class="text-center">
								<button type="submit" id="kt_sign_up_submit" class="btn btn-lg btn-primary" value="Submit">
									<span class="indicator-label">Submit</span>
									<span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
								</button>
							</div>
							<!--end::Actions-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Authentication - Sign-up-->
		</div>
		<!--end::Main-->
		<script>var hostUrl = "/view/assets/";</script>
		<script src="/view/assets/plugins/global/plugins.bundle.js"></script>
		<script>

			var inputElm = document.querySelector('#kt_tagify_users');

			const usersList = [
				{ value: 1, name: 'Envios', avatar: 'avatars/arrow.png', email: 'e.smith@kpmg.com.au' },
				{ value: 2, name: 'Materiales', avatar: 'avatars/arrow.png', email: 'max@kt.com' },
				{ value: 3, name: 'RH', avatar: 'avatars/arrow.png', email: 'sean@dellito.com' },
				{ value: 4, name: 'Mejora Continua', avatar: 'avatars/arrow.png', email: 'brian@exchange.com' },
				{ value: 5, name: 'Seguridad de Higiene', avatar: 'avatars/arrow.png', email: 'f.mitcham@kpmg.com.au' },
				{ value: 6, name: 'Mantenimiento', avatar: 'avatars/arrow.png', email: 'dam@consilting.com' },
				{ value: 7, name: 'Calidad', avatar: 'avatars/arrow.png', email: 'ana.cf@limtel.com' },
				{ value: 8, name: 'Ingenieria', avatar: 'avatars/arrow.png', email: 'miller@mapple.com' },
				{ value: 9, name: 'Tool Crib', avatar: 'avatars/arrow.png', email: 'miller@mapple.com' },
				{ value: 10, name: 'Entrenamiento', avatar: 'avatars/arrow.png', email: 'miller@mapple.com' },
				{ value: 11, name: 'Enfermeria', avatar: 'avatars/arrow.png', email: 'miller@mapple.com' },
				{ value: 12, name: 'Compras', avatar: 'avatars/arrow.png', email: 'miller@mapple.com' },
				{ value: 13, name: 'Almacen', avatar: 'avatars/arrow.png', email: 'miller@mapple.com' },
			];

			function tagTemplate(tagData) {
				return `
					<tag title="${(tagData.title || tagData.email)}"
							contenteditable='false'
							spellcheck='false'
							tabIndex="-1"
							class="${this.settings.classNames.tag} ${tagData.class ? tagData.class : ""}"
							${this.getAttributes(tagData)}>
						<x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>
						<div class="d-flex align-items-center">
							<div class='tagify__tag__avatar-wrap ps-0'>
								<img onerror="this.style.visibility='hidden'" class="rounded-circle w-25px me-2" src="view/assets/media/${tagData.avatar}">
							</div>
							<span class='tagify__tag-text'>${tagData.name}</span>
						</div>
					</tag>
				`
			}

			function suggestionItemTemplate(tagData) {
				return `
					<div ${this.getAttributes(tagData)}
						class='tagify__dropdown__item d-flex align-items-center ${tagData.class ? tagData.class : ""}'
						tabindex="0"
						role="option">

						${tagData.avatar ? `
								<div class='tagify__dropdown__item__avatar-wrap me-2'>
									<img onerror="this.style.visibility='hidden'"  class="rounded-circle w-50px me-2" src="view/assets/media/${tagData.avatar}">
								</div>` : ''
							}

						<div class="d-flex flex-column">
							<strong>${tagData.name}</strong>
						</div>
					</div>
				`
			}

			// initialize Tagify on the above input node reference
			var tagify = new Tagify(inputElm, {
				tagTextProp: 'name', // very important since a custom template is used with this property as text. allows typing a "value" or a "name" to match input with whitelist
				enforceWhitelist: true,
				skipInvalid: true, // do not remporarily add invalid tags
				dropdown: {
					closeOnSelect: false,
					enabled: 0,
					classname: 'users-list',
					searchKeys: ['name', 'email']  // very important to set by which keys to search for suggesttions when typing
				},
				templates: {
					tag: tagTemplate,
					dropdownItem: suggestionItemTemplate
				},
				whitelist: usersList
			})

			tagify.on('dropdown:show dropdown:updated', onDropdownShow)
			tagify.on('dropdown:select', onSelectSuggestion)

			var addAllSuggestionsElm;

			function onDropdownShow(e) {
				var dropdownContentElm = e.detail.tagify.DOM.dropdown.content;

				if (tagify.suggestedListItems.length > 1) {
					addAllSuggestionsElm = getAddAllSuggestionsElm();

					// insert "addAllSuggestionsElm" as the first element in the suggestions list
					dropdownContentElm.insertBefore(addAllSuggestionsElm, dropdownContentElm.firstChild)
				}
			}

			function onSelectSuggestion(e) {
				if (e.detail.elm == addAllSuggestionsElm)
					tagify.dropdown.selectAll.call(tagify);
			}

			// create a "add all" custom suggestion element every time the dropdown changes
			function getAddAllSuggestionsElm() {
				// suggestions items should be based on "dropdownItem" template
				return tagify.parseTemplate('dropdownItem', [{
					class: "addAll",
					name: "Agregar Todos los Departamentos",
					email: tagify.settings.whitelist.reduce(function (remainingSuggestions, item) {
						return tagify.isTagDuplicate(item.value) ? remainingSuggestions : remainingSuggestions + 1
					}, 0) + " Members"
				}]
				)
			}
		</script>
		<!--begin::Javascript-->
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="/view/assets/plugins/global/plugins.bundle.js"></script>
		<script src="/view/assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="/view/assets/js/custom/authentication/sign-up/general.js"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>
	</html>
	<!--end::Body-->