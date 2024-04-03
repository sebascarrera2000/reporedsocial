const { Router } = require("express");
const router = Router();
const mensajesModel = require("../model/mensajesModel");

// Obtener todos los mensajes
router.get("/mensajes", async (req, res) => {
  try {
    const result = await mensajesModel.obtenerMensajes();
    res.json(result);
  } catch (error) {
    console.error("Error al obtener mensajes:", error);
    res.status(500).json({ error: "Error interno del servidor" });
  }
});

// Obtener mensajes de un usuario específico
router.get("/mensajes/:usuarioId", async (req, res) => {
  try {
    const usuarioId = req.params.usuarioId;
    const result = await mensajesModel.obtenerMensajesUsuario(usuarioId);
    res.json(result);
  } catch (error) {
    console.error("Error al obtener mensajes del usuario:", error);
    res.status(500).json({ error: "Error interno del servidor" });
  }
});

// Crear un nuevo mensaje
router.post("/mensajes", async (req, res) => {
  try {
    const { usuarioId, contenido } = req.body;
    await mensajesModel.crearMensaje(usuarioId, contenido);
    res.status(201).json({ message: "Mensaje creado correctamente" });
  } catch (error) {
    console.error("Error al crear mensaje:", error);
    res.status(500).json({ error: "Error interno del servidor" });
  }
});

module.exports = router;
