<<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h2 class="mb-3">ACTUALIZACIÓN DATOS <?php echo date('Y') + 1; ?></h2>

            <?php 
            // Mostramos errores de validación del backend (si existen)
            if (!empty($errors)): 
            ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Error al procesar el formulario:</strong>
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="guardar" method="POST" class="needs-validation" novalidate>
                
                <h3 class="mt-4 fs-4 border-bottom pb-2">1. Antecedentes Personales (Alumno)</h3>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label for="rut_alumno" class="form-label">1. RUT *</label>
                        <input type="text" class="form-control" id="rut_alumno" name="rut_alumno" 
                               value="<?php echo htmlspecialchars($data['rut_alumno'] ?? ''); ?>"
                               pattern="^(\d{1,2}\.?\d{3}\.?\d{3}-[\dkK])$"
                               title="Debe tener formato 12.345.678-9 (con guion y dígito verificador)"
                               required>
                        <div class="invalid-feedback">RUT inválido (ej: 12.345.678-9).</div>
                    </div>
                    <div class="col-md-6">
                        <label for="curso" class="form-label">2. Curso *</label>
                        <select class="form-select" id="curso" name="curso" required>
                            <option value="" selected disabled>Seleccione un curso...</option>
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
                        <div class="invalid-feedback">Debe seleccionar un curso.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="apellido_paterno" class="form-label">3. Apellido Paterno *</label>
                        <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno"
                               value="<?php echo htmlspecialchars($data['apellido_paterno'] ?? ''); ?>"
                               pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+"
                               required>
                        <div class="invalid-feedback">Solo letras y espacios.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="apellido_materno" class="form-label">4. Apellido Materno *</label>
                        <input type="text" class="form-control" id="apellido_materno" name="apellido_materno"
                               value="<?php echo htmlspecialchars($data['apellido_materno'] ?? ''); ?>"
                               pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+"
                               required>
                        <div class="invalid-feedback">Solo letras y espacios.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="nombres_alumno" class="form-label">5. Nombres *</label>
                        <input type="text" class="form-control" id="nombres_alumno" name="nombres_alumno"
                               value="<?php echo htmlspecialchars($data['nombres_alumno'] ?? ''); ?>"
                               pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+"
                               required>
                        <div class="invalid-feedback">Solo letras y espacios.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="nombre_social" class="form-label">6. Nombre Social</label>
                        <input type="text" class="form-control" id="nombre_social" name="nombre_social"
                               value="<?php echo htmlspecialchars($data['nombre_social'] ?? ''); ?>"
                               pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+">
                    </div>
                    <div class="col-md-6">
                        <label for="fecha_nacimiento" class="form-label">8. Fecha de Nacimiento *</label>
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                               value="<?php echo htmlspecialchars($data['fecha_nacimiento'] ?? ''); ?>" required>
                        <div class="invalid-feedback">Fecha inválida.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="domicilio_alumno" class="form-label">9. Domicilio *</label>
                        <input type="text" class="form-control" id="domicilio_alumno" name="domicilio_alumno"
                               value="<?php echo htmlspecialchars($data['domicilio_alumno'] ?? ''); ?>" required>
                        <div class="invalid-feedback">Campo obligatorio.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="poblacion_alumno" class="form-label">10. Población *</label>
                        <input type="text" class="form-control" id="poblacion_alumno" name="poblacion_alumno"
                               value="<?php echo htmlspecialchars($data['poblacion_alumno'] ?? ''); ?>" required>
                        <div class="invalid-feedback">Campo obligatorio.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="comuna_alumno" class="form-label">11. Comuna *</label>
                        <input type="text" class="form-control" id="comuna_alumno" name="comuna_alumno"
                               value="<?php echo htmlspecialchars($data['comuna_alumno'] ?? ''); ?>" required>
                        <div class="invalid-feedback">Campo obligatorio.</div>
                    </div>
                </div>

                <h3 class="mt-5 fs-4 border-bottom pb-2">2. Antecedentes Apoderados</h3>
                
                <h5 class="mt-3 fs-5">12. Apoderado Titular *</h5>
                <div class="row g-3 mt-1 border p-3 rounded-2">
                    <div class="col-md-6">
                        <label for="rut_titular" class="form-label">13. RUT *</label>
                        <input type="text" class="form-control" id="rut_titular" name="rut_titular"
                               pattern="^(\d{1,2}\.?\d{3}\.?\d{3}-[\dkK])$" required>
                        <div class="invalid-feedback">RUT inválido.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="nombre_titular" class="form-label">Nombre Completo *</label>
                        <input type="text" class="form-control" id="nombre_titular" name="nombre_titular"
                               pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+" required>
                        <div class="invalid-feedback">Solo letras.</div>
                    </div>
                     <div class="col-md-6">
                        <label for="direccion_titular" class="form-label">14. Dirección *</label>
                        <input type="text" class="form-control" id="direccion_titular" name="direccion_titular" required>
                        <div class="invalid-feedback">Campo obligatorio.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="poblacion_titular" class="form-label">15. Población *</label>
                        <input type="text" class="form-control" id="poblacion_titular" name="poblacion_titular" required>
                        <div class="invalid-feedback">Campo obligatorio.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="nivel_escolar_titular" class="form-label">16. Nivel Escolar *</label>
                        <input type="text" class="form-control" id="nivel_escolar_titular" name="nivel_escolar_titular" required>
                        <div class="invalid-feedback">Campo obligatorio.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="parentesco_titular" class="form-label">17. Parentesco *</label>
                        <input type="text" class="form-control" id="parentesco_titular" name="parentesco_titular" required>
                        <div class="invalid-feedback">Campo obligatorio.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="profesion_titular" class="form-label">18. Profesión/Actividad *</label>
                        <input type="text" class="form-control" id="profesion_titular" name="profesion_titular" required>
                        <div class="invalid-feedback">Campo obligatorio.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="telefono_titular" class="form-label">19. Teléfono *</label>
                        <input type="tel" class="form-control" id="telefono_titular" name="telefono_titular" required>
                        <div class="invalid-feedback">Campo obligatorio.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="correo_titular" class="form-label">20. Correo Electrónico *</label>
                        <input type="email" class="form-control" id="correo_titular" name="correo_titular" required>
                        <div class="invalid-feedback">Correo inválido.</div>
                    </div>
                </div>

                <h5 class="mt-4 fs-5">21. Apoderado Suplente</h5>
                <div class="row g-3 mt-1 border p-3 rounded-2">
                    <div class="col-md-6">
                        <label for="rut_suplente" class="form-label">22. RUT</label>
                        <input type="text" class="form-control" id="rut_suplente" name="rut_suplente"
                               pattern="^(\d{1,2}\.?\d{3}\.?\d{3}-[\dkK])$">
                        <div class="invalid-feedback">RUT inválido.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="nombre_suplente" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" id="nombre_suplente" name="nombre_suplente"
                               pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+">
                        <div class="invalid-feedback">Solo letras.</div>
                    </div>
                     <div class="col-md-6">
                        <label for="direccion_suplente" class="form-label">23. Dirección</label>
                        <input type="text" class="form-control" id="direccion_suplente" name="direccion_suplente">
                    </div>
                    <div class="col-md-6">
                        <label for="poblacion_suplente" class="form-label">24. Población</label>
                        <input type="text" class="form-control" id="poblacion_suplente" name="poblacion_suplente">
                    </div>
                    <div class="col-md-6">
                        <label for="nivel_escolar_suplente" class="form-label">25. Nivel Escolar</label>
                        <input type="text" class="form-control" id="nivel_escolar_suplente" name="nivel_escolar_suplente">
                    </div>
                    <div class="col-md-6">
                        <label for="parentesco_suplente" class="form-label">26. Parentesco</label>
                        <input type="text" class="form-control" id="parentesco_suplente" name="parentesco_suplente">
                    </div>
                    <div class="col-md-6">
                        <label for="profesion_suplente" class="form-label">27. Profesión/Actividad</label>
                        <input type="text" class="form-control" id="profesion_suplente" name="profesion_suplente">
                    </div>
                    <div class="col-md-6">
                        <label for="telefono_suplente" class="form-label">28. Teléfono</label>
                        <input type="tel" class="form-control" id="telefono_suplente" name="telefono_suplente">
                    </div>
                    <div class="col-md-6">
                        <label for="correo_suplente" class="form-label">29. Correo Electrónico</label>
                        <input type="email" class="form-control" id="correo_suplente" name="correo_suplente">
                    </div>
                </div>

                <h3 class="mt-5 fs-4 border-bottom pb-2">3. Persona que retira en caso de emergencia</h3>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label for="retira_1_nombre" class="form-label">30. Nombre Persona 1 *</label>
                        <input type="text" class="form-control" id="retira_1_nombre" name="retira_1_nombre" required>
                        <div class="invalid-feedback">Campo obligatorio.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="retira_1_telefono" class="form-label">31. Teléfono Persona 1 *</label>
                        <input type="tel" class="form-control" id="retira_1_telefono" name="retira_1_telefono" required>
                        <div class="invalid-feedback">Campo obligatorio.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="retira_2_nombre" class="form-label">32. Nombre Persona 2</label>
                        <input type="text" class="form-control" id="retira_2_nombre" name="retira_2_nombre">
                    </div>
                    <div class="col-md-6">
                        <label for="retira_2_telefono" class="form-label">33. Teléfono Persona 2</label>
                        <input type="tel" class="form-control" id="retira_2_telefono" name="retira_2_telefono">
                    </div>
                </div>

                <h3 class="mt-5 fs-4 border-bottom pb-2">4. Antecedentes Familiares</h3>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label class="form-label">38. El alumno vive con: *</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="vive_con[]" value="Mama" id="vive_mama">
                            <label class="form-check-label" for="vive_mama">Mamá</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="vive_con[]" value="Papa" id="vive_papa">
                            <label class="form-check-label" for="vive_papa">Papá</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="vive_con[]" value="Otro" id="vive_otro">
                            <label class="form-check-label" for="vive_otro">Otro</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="n_integrantes_familia" class="form-label">39. N° Integrantes Grupo Familiar *</label>
                        <input type="number" class="form-control" id="n_integrantes_familia" name="n_integrantes_familia" min="1" required>
                        <div class="invalid-feedback">Campo obligatorio.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="n_hijos" class="form-label">40. N° de Hijos *</label>
                        <input type="number" class="form-control" id="n_hijos" name="n_hijos" min="0" required>
                        <div class="invalid-feedback">Campo obligatorio.</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">41. Registro Social de Hogares *</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rsh_tiene" id="rsh_si" value="1" required>
                            <label class="form-check-label" for="rsh_si">SI</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rsh_tiene" id="rsh_no" value="0" required>
                            <label class="form-check-label" for="rsh_no">NO</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="rsh_puntaje" class="form-label">42. Puntaje R.S.H.</label>
                        <input type="text" class="form-control" id="rsh_puntaje" name="rsh_puntaje">
                        <small class="text-muted">(Dejar en blanco si no tiene)</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">43. Restricción Judicial *</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="restriccion_judicial" id="restriccion_si" value="1" required>
                            <label class="form-check-label" for="restriccion_si">SI</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="restriccion_judicial" id="restriccion_no" value="0" required>
                            <label class="form-check-label" for="restriccion_no">NO</label>
                        </div>
                    </div>
                     <div class="col-12">
                        <label for="restriccion_motivo" class="form-label">44. Si su respuesta es "SI", Indicar motivo.</label>
                        <textarea class="form-control" id="restriccion_motivo" name="restriccion_motivo" rows="2"></textarea>
                    </div>
                </div>

                <h3 class="mt-5 fs-4 border-bottom pb-2">5. Observaciones de Salud</h3>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label class="form-label">45. ¿Alumno presenta algún diagnóstico? *</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="diagnostico" id="diag_si" value="1" required>
                            <label class="form-check-label" for="diag_si">SI</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="diagnostico" id="diag_no" value="0" required>
                            <label class="form-check-label" for="diag_no">NO</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">46. ¿Entrega documento? *</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="diagnostico_documento" id="doc_diag_si" value="1" required>
                            <label class="form-check-label" for="doc_diag_si">SI</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="diagnostico_documento" id="doc_diag_no" value="0" required>
                            <label class="form-check-label" for="doc_diag_no">NO</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">47. ¿Alumno está con tratamiento? *</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tratamiento" id="trat_si" value="1" required>
                            <label class="form-check-label" for="trat_si">SI</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tratamiento" id="trat_no" value="0" required>
                            <label class="form-check-label" for="trat_no">NO</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="enfermedad" class="form-label">49. ¿Presenta alguna enfermedad?</label>
                        <textarea class="form-control" id="enfermedad" name="enfermedad" rows="2"></textarea>
                    </div>
                     <div class="col-12">
                        <label for="alergia_medicamento" class="form-label">50. ¿Alérgico a algún medicamento? *</label>
                        <textarea class="form-control" id="alergia_medicamento" name="alergia_medicamento" rows="2" required></textarea>
                        <div class="invalid-feedback">Campo obligatorio (Escriba "NINGUNA" si aplica).</div>
                    </div>
                </div>

                <h3 class="mt-5 fs-4 border-bottom pb-2">6. Toma de Conocimientos</h3>
                <div class="row g-3 mt-2">
                    <div class="col-12 form-check">
                        <input type="checkbox" class="form-check-input" name="acepta_reglamento" value="1" id="acepta_reglamento" required>
                        <label class="form-check-label" for="acepta_reglamento">
                            51. Acepto el reglamento interno del colegio, Manual de convivencia del colegio y Reglamento de evaluación, 
                            los cuales se encuentran disponibles y actualizados en el sitio web del establecimiento
                             (www.academiahospicio.cl).
                        </label>
                        <div class="invalid-feedback">Debe aceptar este punto.</div>
                    </div>
                    <div class="col-12 form-check">
                        <input type="checkbox" class="form-check-input" name="acepta_no_pie" value="1" id="acepta_no_pie" required>
                        <label class="form-check-label" for="acepta_no_pie">
                            52. Acepto que el colegio no cuenta con programa de integración escolar (PIE), 
                            por lo que asumo la responsabilidad de brindar apoyo multidisciplinario 
                            externo en caso de que mi pupilo(a) lo requiera.
                        </label>
                        <div class="invalid-feedback">Debe aceptar este punto.</div>
                    </div>
                    <div class="col-12 form-check">
                        <input type="checkbox" class="form-check-input" name="acepta_mensajeria" value="1" id="acepta_mensajeria" required>
                        <label class="form-check-label" for="acepta_mensajeria">
                            53. Me doy por enterado de que el colegio envía información y comunicaciones mediante 
                            mensajería instantánea, por lo que es mi responsabilidad agregar a mis contactos el 
                            N° +56 57 276 8954, y enviar un mensaje indicando: “Apoderado titular o 
                            suplente + curso + nombre del alumno(a)”a dicho número, para ser agregado a las listas 
                            de distribución correspondientes.
                        </label>
                        <div class="invalid-feedback">Debe aceptar este punto.</div>
                    </div>
                    <div class="col-12 form-check">
                        <input type="checkbox" class="form-check-input" name="acepta_fotos_rrss" value="1" id="acepta_fotos_rrss" required>
                        <label class="form-check-label" for="acepta_fotos_rrss">
                            54. Acepto que el colegio entreviste, tome fotos y/o videos de mi pupilo(a) en actividades 
                            educativas, recreativas, ceremoniales, y/o cualquier otra actividad pedagógica o de convivencia 
                            escolar relacionada con el establecimiento, y utilice el material para ser publicado en las rr.ss. 
                            y página web del colegio. Cedo todos los derechos de dicho material a la Academia Hospicio,
                             y me abstengo de entablar cualquier acción en contra del establecimiento y/o en contra de terceros
                              relacionados con el colegio.
                        </label>
                        <div class="invalid-feedback">Debe aceptar este punto.</div>
                    </div>
                </div>

                <h3 class="mt-5 fs-4 border-bottom pb-2">7. Documentación Adjunta</h3>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label class="form-label">55. Certificado de Nacimiento *</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="doc_certificado_nacimiento" id="doc_nac_si" value="1" required>
                            <label class="form-check-label" for="doc_nac_si">SI</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="doc_certificado_nacimiento" id="doc_nac_no" value="0" required>
                            <label class="form-check-label" for="doc_nac_no">NO</label>
                        </div>
                    </div>
                    </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">
                    <button class="btn btn-secondary btn-lg" type="reset">Limpiar Formulario</button>
                    <button class="btn btn-primary btn-lg" type="submit">Guardar Matrícula</button>
                </div>
            </form>
        </div>
    </div>
</div>