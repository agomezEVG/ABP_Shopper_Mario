class M_validarNPC {
    constructor(data) {
        this.data = data; // Aquí se guardará la información del NPC
    }

    async guardar() {
        try {
            const respuesta = await fetch('../admin/index.php?c=NPC&m=guardarNPC', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(this.data),
            });

            if (!respuesta.ok) {
                throw new Error('Error en la respuesta del servidor');
            }

            const respuestaJson = await respuesta.json();
            return respuestaJson;
        } catch (error) {
            return { success: false, error: 'Ocurrió un problema al guardar el NPC. Intenta de nuevo más tarde.' };
        }
    }

    async obtenerTodos() {
        try {
            const respuesta = await fetch('../admin/index.php?c=NPC&m=obtenerNPCs', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            });

            if (!respuesta.ok) {
                throw new Error('Error en la respuesta del servidor');
            }

            const respuestaJson = await respuesta.json();
            return respuestaJson;
        } catch (error) {
            return { success: false, error: 'Ocurrió un problema al obtener los NPCs. Intenta de nuevo más tarde.' };
        }
    }
}

export default M_validarNPC;