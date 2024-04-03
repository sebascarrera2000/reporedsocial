const { Router } = require("express");
const router = Router();
const seguimientosModel = require("../model/followModel");

// Seguir a un usuario
router.post("/seguimientos", async (req, res) => {
  try {
    const { usuarioP, usuarioS } = req.body;
    await seguimientosModel.seguirUsuario(usuarioP, usuarioS);
    res.status(201).json({ message: "Se ha seguido al usuario correctamente" });
  } catch (error) {
    console.error("Error al seguir al usuario:", error);
    res.status(500).json({ error: "Error interno del servidor" });
  }
});

// Obtener usuarios seguidos por un usuario id
router.get("/seguimientos/:usuarioP", async (req, res) => {
  try {
    const usuarioP = req.params.usuarioP;
    const result = await seguimientosModel.obtenerUsuariosSeguidos(usuarioP);
    res.json(result);
  } catch (error) {
    console.error("Error al obtener usuarios seguidos:", error);
    res.status(500).json({ error: "Error interno del servidor" });
  }
});

module.exports = router;
