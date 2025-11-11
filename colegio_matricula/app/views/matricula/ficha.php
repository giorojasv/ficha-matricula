<div class="container my-5">
    <div class="row">
        <div class="col-12 text-end no-print mb-3 d-flex justify-content-end gap-2">
            <a href="<?php echo BASE_URL; ?>" class="btn btn-secondary">
                Registrar Nuevo Alumno
            </a>
            <button onclick="window.print()" class="btn btn-primary">
                🖨️ Imprimir Ficha
            </button>
        </div>
    </div>
    
    <div class="row border p-4">
        <div class="col-6">
            <h3 class="text-primary">ACTUALIZACIÓN DATOS </h3>
        </div>
        <div class="col-6 text-end">
            <h4>Ficha de Matrícula <?php echo date('Y') + 1; ?></h4>
            <p class="mb-0">
                <strong>ID Alumno:</strong> <?php echo htmlspecialchars($ficha['id_alumno']); ?>
            </p>
            <p>
                <strong>Fecha Emisión:</strong> <?php echo date('d-m-Y'); ?>
            </p>
        </div>
        
        <hr class="my-3">
        
        <div class="col-12">
            <h5>1. Antecedentes Personales (Alumno)</h5>
            <table class="table table-bordered table-sm">
                <tbody>
                    <tr>
                        <td class="bg-light" style="width: 25%;"><strong>Nombre Completo:</strong></td>
                        <td><?php echo htmlspecialchars("{$ficha['nombre']} {$ficha['apellido_paterno']} {$ficha['apellido_materno']}"); ?></td>
                    </tr>
                     <tr>
                        <td class="bg-light"><strong>Nombre Social:</strong></td>
                        <td><?php echo htmlspecialchars($ficha['nombre_social'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light"><strong>RUT:</strong></td>
                        <td><?php echo htmlspecialchars($ficha['rut']); ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light"><strong>Fecha Nacimiento:</strong></td>
                        <td><?php echo htmlspecialchars($ficha['fecha_nacimiento']); ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light"><strong>Curso Matriculado:</strong></td>
                        <td><?php echo htmlspecialchars($ficha['curso']); ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light"><strong>Domicilio:</strong></td>
                        <td><?php echo htmlspecialchars("{$ficha['domicilio']}, {$ficha['poblacion']}, {$ficha['comuna']}"); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-12 mt-4">
            <h5>2. Antecedentes Apoderados</h5>
            
            <h6 class="mt-3">Apoderado Titular</h6>
            <table class="table table-bordered table-sm">
                <tbody>
                    <tr>
                        <td class="bg-light" style="width: 25%;"><strong>Nombre:</strong></td>
                        <td><?php echo htmlspecialchars($ficha['nombre_titular']); ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light"><strong>RUT:</strong></td>
                        <td><?php echo htmlspecialchars($ficha['rut_titular']); ?></td>
                    </tr>
                     <tr>
                        <td class="bg-light"><strong>Parentesco:</strong></td>
                        <td><?php echo htmlspecialchars($ficha['parentesco_titular']); ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light"><strong>Teléfono:</strong></td>
                        <td><?php echo htmlspecialchars($ficha['telefono_titular']); ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light"><strong>Correo:</strong></td>
                        <td><?php echo htmlspecialchars($ficha['correo_titular']); ?></td>
                    </tr>
                </tbody>
            </table>

            <?php if (!empty($ficha['rut_suplente'])): ?>
                <h6 class="mt-3">Apoderado Suplente</h6>
                <table class="table table-bordered table-sm">
                    <tbody>
                        <tr>
                            <td class="bg-light" style="width: 25%;"><strong>Nombre:</strong></td>
                            <td><?php echo htmlspecialchars($ficha['nombre_suplente']); ?></td>
                        </tr>
                        <tr>
                            <td class="bg-light"><strong>RUT:</strong></td>
                            <td><?php echo htmlspecialchars($ficha['rut_suplente']); ?></td>
                        </tr>
                        <tr>
                            <td class="bg-light"><strong>Teléfono:</strong></td>
                            <td><?php echo htmlspecialchars($ficha['telefono_suplente']); ?></td>
                        </tr>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        
        <div class="col-12 mt-4">
            <h5>3. Personas que retiran en caso de emergencia</h5>
            <table class="table table-bordered table-sm">
                <thead>
                    <tr class="bg-light">
                        <th>Nombre</th>
                        <th>Teléfono</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo htmlspecialchars($ficha['retira_emergencia_1_nombre']); ?></td>
                        <td><?php echo htmlspecialchars($ficha['retira_emergencia_1_telefono']); ?></td>
                    </tr>
                    <?php if (!empty($ficha['retira_emergencia_2_nombre'])): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($ficha['retira_emergencia_2_nombre']); ?></td>
                        <td><?php echo htmlspecialchars($ficha['retira_emergencia_2_telefono']); ?></td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="col-12 mt-4">
            <h5>4. Antecedentes Familiares</h5>
            <table class="table table-bordered table-sm">
                <tbody>
                    <tr>
                        <td class="bg-light" style="width: 40%;"><strong>El alumno vive con:</strong></td>
                        <td><?php echo htmlspecialchars($ficha['alumno_vive_con']); ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light"><strong>N° Integrantes Grupo Familiar:</strong></td>
                        <td><?php echo htmlspecialchars($ficha['n_integrantes_familia']); ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light"><strong>N° de Hijos:</strong></td>
                        <td><?php echo htmlspecialchars($ficha['n_hijos']); ?></td>
                    </tr>
                     <tr>
                        <td class="bg-light"><strong>Puntaje R.S.H.:</strong></td>
                        <td><?php echo htmlspecialchars($ficha['rsh_puntaje'] ?? 'N/A'); ?></td>
                    </tr>
                     <tr>
                        <td class="bg-light"><strong>Restricción Judicial:</strong></td>
                        <td><?php echo $ficha['restriccion_judicial'] ? 'SI' : 'NO'; ?></td>
                    </tr>
                    <?php if ($ficha['restriccion_judicial']): ?>
                    <tr>
                        <td class="bg-light"><strong>Motivo Restricción:</strong></td>
                        <td><?php echo htmlspecialchars($ficha['restriccion_motivo']); ?></td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="col-12 mt-4">
            <h5>5. Observaciones de Salud</h5>
            <table class="table table-bordered table-sm">
                <tbody>
                    <tr>
                        <td class="bg-light" style="width: 40%;"><strong>¿Presenta diagnóstico?:</strong></td>
                        <td><?php echo $ficha['diagnostico'] ? 'SI' : 'NO'; ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light"><strong>¿Entrega documento?:</strong></td>
                        <td><?php echo $ficha['diagnostico_documento'] ? 'SI' : 'NO'; ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light"><strong>¿Está con tratamiento?:</strong></td>
                        <td><?php echo $ficha['tratamiento'] ? 'SI' : 'NO'; ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light"><strong>Enfermedad (si presenta):</strong></td>
                        <td><?php echo htmlspecialchars($ficha['enfermedad'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light"><strong>Alergia a Medicamento:</strong></td>
                        <td><?php echo htmlspecialchars($ficha['alergia_medicamento']); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-12 mt-4">
            <h5>6. Toma de Conocimientos</h5>
            <table class="table table-bordered table-sm">
                <tbody>
                    <tr>
                        <td class="bg-light" style="width: 40%;"><strong>Acepta Reglamento Interno:</strong></td>
                        <td><?php echo $ficha['acepta_reglamento'] ? 'SI' : 'NO'; ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light"><strong>Acepta declaración NO-PIE:</strong></td>
                        <td><?php echo $ficha['acepta_no_pie'] ? 'SI' : 'NO'; ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light"><strong>Enterado de Mensajería:</strong></td>
                        <td><?php echo $ficha['acepta_mensajeria'] ? 'SI' : 'NO'; ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light"><strong>Acepta uso de fotos (RRSS):</strong></td>
                        <td><?php echo $ficha['acepta_fotos_rrss'] ? 'SI' : 'NO'; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    </div>