<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <form action="<?php echo BASE_URL . 'admin/actualizar/' . $ficha['id_alumno']; ?>" 
                  method="POST" class="needs-validation" novalidate>
            
            <h2 class="mb-3">Editando Ficha: <?php echo htmlspecialchars($ficha['nombre']); ?></h2>

            <h3 class="mt-4 fs-4 border-bottom pb-2">1. Antecedentes Personales (Alumno)</h3>
            <div class="row g-3 mt-2">
                <div class="col-md-6">
                    <label for="rut_alumno" class="form-label">1. RUT *</label>
                    <input type="text" class="form-control" id="rut_alumno" name="rut_alumno" 
                           value="<?php echo htmlspecialchars($ficha['rut']); ?>"
                           pattern="^(\d{1,2}\.?\d{3}\.?\d{3}-[\dkK])$" required>
                </div>
                <div class="col-md-6">
                    <label for="curso" class="form-label">2. Curso *</label>
                    <select class="form-select" id="curso" name="curso" required>
                        <option value="<?php echo htmlspecialchars($ficha['curso']); ?>" selected>
                            <?php echo htmlspecialchars($ficha['curso']); ?> (Actual)
                        </option>
                        <option value="NT1">NT1</option>
                        <option value="NT2">NT2</option>
                        <option value="1 Básico">1° Básico</option>
                        <option value="2 Básico">2° Básico</option>
                        <option value="3 Básico">3º Básico</option>
                        <option value="4 Básico">4° Básico</option>
                        <option value="5 Básico">5° Básico</option>
                        <option value="6 Básico">6° Básico</option>
                        <option value="7 Básico">7° Básico</option>
                        <option value="8 Básico">8° Básico</option>
                        <option value="1 Medio">1° Medio</option>
                        <option value="2 Medio">2° Medio</option>
                        <option value="3 Medio">3° Medio</option>
                        <option value="4 Medio">4° Medio</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="apellido_paterno" class="form-label">3. Apellido Paterno *</label>
                    <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno"
                           value="<?php echo htmlspecialchars($ficha['apellido_paterno']); ?>"
                           pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+" required>
                </div>
                <div class="col-md-6">
                    <label for="apellido_materno" class="form-label">4. Apellido Materno *</label>
                    <input type="text" class="form-control" id="apellido_materno" name="apellido_materno"
                           value="<?php echo htmlspecialchars($ficha['apellido_materno']); ?>"
                           pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+" required>
                </div>
                <div class="col-md-6">
                    <label for="nombres_alumno" class="form-label">5. Nombres *</label>
                    <input type="text" class="form-control" id="nombres_alumno" name="nombres_alumno"
                           value="<?php echo htmlspecialchars($ficha['nombre']); ?>"
                           pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+" required>
                </div>
                <div class="col-md-6">
                    <label for="nombre_social" class="form-label">6. Nombre Social</label>
                    <input type="text" class="form-control" id="nombre_social" name="nombre_social"
                           value="<?php echo htmlspecialchars($ficha['nombre_social'] ?? ''); ?>"
                           pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+">
                </div>
                <div class="col-md-6">
                    <label for="fecha_nacimiento" class="form-label">8. Fecha de Nacimiento *</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                           value="<?php echo htmlspecialchars($ficha['fecha_nacimiento']); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="domicilio_alumno" class="form-label">9. Domicilio *</label>
                    <input type="text" class="form-control" id="domicilio_alumno" name="domicilio_alumno"
                           value="<?php echo htmlspecialchars($ficha['domicilio']); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="poblacion_alumno" class="form-label">10. Población *</label>
                    <input type="text" class="form-control" id="poblacion_alumno" name="poblacion_alumno"
                           value="<?php echo htmlspecialchars($ficha['poblacion']); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="comuna_alumno" class="form-label">11. Comuna *</label>
                    <input type="text" class="form-control" id="comuna_alumno" name="comuna_alumno"
                           value="<?php echo htmlspecialchars($ficha['comuna']); ?>" required>
                </div>
            </div>

            <h3 class="mt-5 fs-4 border-bottom pb-2">2. Antecedentes Apoderados</h3>
            
            <h5 class="mt-3 fs-5">12. Apoderado Titular *</h5>
            <div class="row g-3 mt-1 border p-3 rounded-2">
                <input type="hidden" name="id_titular_hidden" value="<?php echo $ficha['id_apoderado_titular'] ?? ''; ?>">
                
                <div class="col-md-6">
                    <label for="rut_titular" class="form-label">13. RUT *</label>
                    <input type="text" class="form-control" id="rut_titular" name="rut_titular"
                           value="<?php echo htmlspecialchars($ficha['rut_titular'] ?? ''); ?>"
                           pattern="^(\d{1,2}\.?\d{3}\.?\d{3}-[\dkK])$" required>
                </div>
                <div class="col-md-6">
                    <label for="nombre_titular" class="form-label">Nombre Completo *</label>
                    <input type="text" class="form-control" id="nombre_titular" name="nombre_titular"
                           value="<?php echo htmlspecialchars($ficha['nombre_titular'] ?? ''); ?>"
                           pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+" required>
                </div>
                 <div class="col-md-6">
                    <label for="direccion_titular" class="form-label">14. Dirección *</label>
                    <input type="text" class="form-control" id="direccion_titular" name="direccion_titular" 
                           value="<?php echo htmlspecialchars($ficha['direccion_titular'] ?? ''); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="poblacion_titular" class="form-label">15. Población *</label>
                    <input type="text" class="form-control" id="poblacion_titular" name="poblacion_titular" 
                           value="<?php echo htmlspecialchars($ficha['poblacion_titular'] ?? ''); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="nivel_escolar_titular" class="form-label">16. Nivel Escolar *</label>
                    <input type="text" class="form-control" id="nivel_escolar_titular" name="nivel_escolar_titular" 
                           value="<?php echo htmlspecialchars($ficha['nivel_escolar_titular'] ?? ''); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="parentesco_titular" class="form-label">17. Parentesco *</label>
                    <input type="text" class="form-control" id="parentesco_titular" name="parentesco_titular" 
                           value="<?php echo htmlspecialchars($ficha['parentesco_titular'] ?? ''); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="profesion_titular" class="form-label">18. Profesión/Actividad *</label>
                    <input type="text" class="form-control" id="profesion_titular" name="profesion_titular" 
                           value="<?php echo htmlspecialchars($ficha['profesion_titular'] ?? ''); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="telefono_titular" class="form-label">19. Teléfono *</label>
                    <input type="tel" class="form-control" id="telefono_titular" name="telefono_titular" 
                           value="<?php echo htmlspecialchars($ficha['telefono_titular'] ?? ''); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="correo_titular" class="form-label">20. Correo Electrónico *</label>
                    <input type="email" class="form-control" id="correo_titular" name="correo_titular" 
                           value="<?php echo htmlspecialchars($ficha['correo_titular'] ?? ''); ?>" required>
                </div>
            </div>

            <h5 class="mt-4 fs-5">21. Apoderado Suplente</h5>
            <div class="row g-3 mt-1 border p-3 rounded-2">
                <input type="hidden" name="id_suplente_hidden" value="<?php echo $ficha['id_apoderado_suplente'] ?? ''; ?>">
                <div class="col-md-6">
                    <label for="rut_suplente" class="form-label">22. RUT</label>
                    <input type="text" class="form-control" id="rut_suplente" name="rut_suplente"
                           value="<?php echo htmlspecialchars($ficha['rut_suplente'] ?? ''); ?>"
                           pattern="^(\d{1,2}\.?\d{3}\.?\d{3}-[\dkK])$">
                </div>
                <div class="col-md-6">
                    <label for="nombre_suplente" class="form-label">Nombre Completo</label>
                    <input type="text" class="form-control" id="nombre_suplente" name="nombre_suplente"
                           value="<?php echo htmlspecialchars($ficha['nombre_suplente'] ?? ''); ?>"
                           pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+">
                </div>
                 <div class="col-md-6">
                    <label for="direccion_suplente" class="form-label">23. Dirección</label>
                    <input type="text" class="form-control" id="direccion_suplente" name="direccion_suplente"
                           value="<?php echo htmlspecialchars($ficha['direccion_suplente'] ?? ''); ?>">
                </div>
                <div class="col-md-6">
                    <label for="poblacion_suplente" class="form-label">24. Población</label>
                    <input type="text" class="form-control" id="poblacion_suplente" name="poblacion_suplente"
                           value="<?php echo htmlspecialchars($ficha['poblacion_suplente'] ?? ''); ?>">
                </div>
                <div class="col-md-6">
                    <label for="nivel_escolar_suplente" class="form-label">25. Nivel Escolar</label>
                    <input type="text" class="form-control" id="nivel_escolar_suplente" name="nivel_escolar_suplente"
                           value="<?php echo htmlspecialchars($ficha['nivel_escolar_suplente'] ?? ''); ?>">
                </div>
                <div class="col-md-6">
                    <label for="parentesco_suplente" class="form-label">26. Parentesco</label>
                    <input type="text" class="form-control" id="parentesco_suplente" name="parentesco_suplente"
                           value="<?php echo htmlspecialchars($ficha['parentesco_suplente'] ?? ''); ?>">
                </div>
                <div class="col-md-6">
                    <label for="profesion_suplente" class="form-label">27. Profesión/Actividad</label>
                    <input type="text" class="form-control" id="profesion_suplente" name="profesion_suplente"
                           value="<?php echo htmlspecialchars($ficha['profesion_suplente'] ?? ''); ?>">
                </div>
                <div class="col-md-6">
                    <label for="telefono_suplente" class="form-label">28. Teléfono</label>
                    <input type="tel" class="form-control" id="telefono_suplente" name="telefono_suplente"
                           value="<?php echo htmlspecialchars($ficha['telefono_suplente'] ?? ''); ?>">
                </div>
                <div class="col-md-6">
                    <label for="correo_suplente" class="form-label">29. Correo Electrónico</label>
                    <input type="email" class="form-control" id="correo_suplente" name="correo_suplente"
                           value="<?php echo htmlspecialchars($ficha['correo_suplente'] ?? ''); ?>">
                </div>
            </div>

            <h3 class="mt-5 fs-4 border-bottom pb-2">3. Persona que retira en caso de emergencia</h3>
            <div class="row g-3 mt-2">
                <div class="col-md-6">
                    <label for="retira_1_nombre" class="form-label">30. Nombre Persona 1 *</label>
                    <input type="text" class="form-control" id="retira_1_nombre" name="retira_1_nombre" 
                           value="<?php echo htmlspecialchars($ficha['retira_emergencia_1_nombre'] ?? ''); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="retira_1_telefono" class="form-label">31. Teléfono Persona 1 *</label>
                    <input type="tel" class="form-control" id="retira_1_telefono" name="retira_1_telefono" 
                           value="<?php echo htmlspecialchars($ficha['retira_emergencia_1_telefono'] ?? ''); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="retira_2_nombre" class="form-label">32. Nombre Persona 2</label>
                    <input type="text" class="form-control" id="retira_2_nombre" name="retira_2_nombre"
                           value="<?php echo htmlspecialchars($ficha['retira_emergencia_2_nombre'] ?? ''); ?>">
                </div>
                <div class="col-md-6">
                    <label for="retira_2_telefono" class="form-label">33. Teléfono Persona 2</label>
                    <input type="tel" class="form-control" id="retira_2_telefono" name="retira_2_telefono"
                           value="<?php echo htmlspecialchars($ficha['retira_emergencia_2_telefono'] ?? ''); ?>">
                </div>
            </div>

            <h3 class="mt-5 fs-4 border-bottom pb-2">4. Antecedentes Familiares</h3>
            <div class="row g-3 mt-2">
                <div class="col-md-6">
                    <label class="form-label">38. El alumno vive con: *</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="vive_con[]" value="Mama" id="vive_mama"
                            <?php if (in_array('Mama', $ficha['vive_con_array'] ?? [])) echo 'checked'; ?>>
                        <label class="form-check-label" for="vive_mama">Mamá</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="vive_con[]" value="Papa" id="vive_papa"
                            <?php if (in_array('Papa', $ficha['vive_con_array'] ?? [])) echo 'checked'; ?>>
                        <label class="form-check-label" for="vive_papa">Papá</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="vive_con[]" value="Otro" id="vive_otro"
                            <?php if (in_array('Otro', $ficha['vive_con_array'] ?? [])) echo 'checked'; ?>>
                        <label class="form-check-label" for="vive_otro">Otro</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="n_integrantes_familia" class="form-label">39. N° Integrantes Grupo Familiar *</label>
                    <input type="number" class="form-control" id="n_integrantes_familia" name="n_integrantes_familia" min="1" 
                           value="<?php echo htmlspecialchars($ficha['n_integrantes_familia'] ?? '1'); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="n_hijos" class="form-label">40. N° de Hijos *</label>
                    <input type="number" class="form-control" id="n_hijos" name="n_hijos" min="0" 
                           value="<?php echo htmlspecialchars($ficha['n_hijos'] ?? '0'); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="rsh_puntaje" class="form-label">42. Puntaje R.S.H.</label>
                    <input type="text" class="form-control" id="rsh_puntaje" name="rsh_puntaje"
                           value="<?php echo htmlspecialchars($ficha['rsh_puntaje'] ?? ''); ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">43. Restricción Judicial *</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="restriccion_judicial" id="restriccion_si" value="1" 
                            <?php if ($ficha['restriccion_judicial'] == 1) echo 'checked'; ?> required>
                        <label class="form-check-label" for="restriccion_si">SI</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="restriccion_judicial" id="restriccion_no" value="0" 
                            <?php if ($ficha['restriccion_judicial'] == 0) echo 'checked'; ?> required>
                        <label class="form-check-label" for="restriccion_no">NO</label>
                    </div>
                </div>
                 <div class="col-12">
                    <label for="restriccion_motivo" class="form-label">44. Si su respuesta es "SI", Indicar motivo.</label>
                    <textarea class="form-control" id="restriccion_motivo" name="restriccion_motivo" rows="2"><?php echo htmlspecialchars($ficha['restriccion_motivo'] ?? ''); ?></textarea>
                </div>
            </div>

            <h3 class="mt-5 fs-4 border-bottom pb-2">5. Observaciones de Salud</h3>
            <div class="row g-3 mt-2">
                <div class="col-md-6">
                    <label class="form-label">45. ¿Alumno presenta algún diagnóstico? *</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="diagnostico" id="diag_si" value="1" 
                            <?php if ($ficha['diagnostico'] == 1) echo 'checked'; ?> required>
                        <label class="form-check-label" for="diag_si">SI</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="diagnostico" id="diag_no" value="0" 
                            <?php if ($ficha['diagnostico'] == 0) echo 'checked'; ?> required>
                        <label class="form-check-label" for="diag_no">NO</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">46. ¿Entrega documento? *</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="diagnostico_documento" id="doc_diag_si" value="1" 
                            <?php if ($ficha['diagnostico_documento'] == 1) echo 'checked'; ?> required>
                        <label class="form-check-label" for="doc_diag_si">SI</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="diagnostico_documento" id="doc_diag_no" value="0" 
                            <?php if ($ficha['diagnostico_documento'] == 0) echo 'checked'; ?> required>
                        <label class="form-check-label" for="doc_diag_no">NO</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">47. ¿Alumno está con tratamiento? *</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tratamiento" id="trat_si" value="1" 
                            <?php if ($ficha['tratamiento'] == 1) echo 'checked'; ?> required>
                        <label class="form-check-label" for="trat_si">SI</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tratamiento" id="trat_no" value="0" 
                            <?php if ($ficha['tratamiento'] == 0) echo 'checked'; ?> required>
                        <label class="form-check-label" for="trat_no">NO</label>
                    </div>
                </div>
                <div class="col-12">
                    <label for="enfermedad" class="form-label">49. ¿Presenta alguna enfermedad?</label>
                    <textarea class="form-control" id="enfermedad" name="enfermedad" rows="2"><?php echo htmlspecialchars($ficha['enfermedad'] ?? ''); ?></textarea>
                </div>
                 <div class="col-12">
                    <label for="alergia_medicamento" class="form-label">50. ¿Alérgico a algún medicamento? *</label>
                    <textarea class="form-control" id="alergia_medicamento" name="alergia_medicamento" rows="2" required><?php echo htmlspecialchars($ficha['alergia_medicamento'] ?? ''); ?></textarea>
                </div>
            </div>

            <h3 class="mt-5 fs-4 border-bottom pb-2">6. Toma de Conocimientos</h3>
            <div class="row g-3 mt-2">
                <div class="col-12 form-check">
                    <input type="checkbox" class="form-check-input" name="acepta_reglamento" value="1" id="acepta_reglamento"
                        <?php if ($ficha['acepta_reglamento'] == 1) echo 'checked'; ?>>
                    <label class="form-check-label" for="acepta_reglamento">
                        51. Acepto el reglamento interno del colegio...
                    </label>
                </div>
                <div class="col-12 form-check">
                    <input type="checkbox" class="form-check-input" name="acepta_no_pie" value="1" id="acepta_no_pie"
                        <?php if ($ficha['acepta_no_pie'] == 1) echo 'checked'; ?>>
                    <label class="form-check-label" for="acepta_no_pie">
                        52. Acepto que el colegio no cuenta con programa de integración escolar (PIE)...
                    </label>
                </div>
                <div class="col-12 form-check">
                    <input type="checkbox" class="form-check-input" name="acepta_mensajeria" value="1" id="acepta_mensajeria"
                        <?php if ($ficha['acepta_mensajeria'] == 1) echo 'checked'; ?>>
                    <label class="form-check-label" for="acepta_mensajeria">
                        53. Me doy por enterado de que el colegio envía información por mensajería instantánea...
                    </label>
                </div>
                <div class="col-12 form-check">
                    <input type="checkbox" class="form-check-input" name="acepta_fotos_rrss" value="1" id="acepta_fotos_rrss"
                        <?php if ($ficha['acepta_fotos_rrss'] == 1) echo 'checked'; ?>>
                    <label class="form-check-label" for="acepta_fotos_rrss">
                        54. Acepto que el colegio entreviste, tome fotos y/o videos de mi pupilo(a)...
                    </label>
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-end gap-2">
                <a href="<?php echo BASE_URL; ?>admin/dashboard" class="btn btn-secondary btn-lg">Cancelar</a>
                <button class="btn btn-primary btn-lg" type="submit">Guardar Cambios</button>
            </div>
            </form>
        </div>
    </div>
</div>