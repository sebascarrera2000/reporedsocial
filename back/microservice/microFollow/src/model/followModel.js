const mysql = require("mysql2/promise");
const connection = mysql.createPool({
  host: "localhost",
  user: "root",
  password: "",
  database: "redsocial",
});

// Crear el seguimiento de un usuario 

async function seguirUsuario(usuarioP, usuarioS) {
  const result = await connection.query(
    "INSERT INTO Seguimientos (usuarioP_id, usuarioS_id) VALUES (?, ?)",
    [usuarioP, usuarioS]
  );
  return result;
}

// Obtener los usuarios seguiodos por el id del usuario Principal
async function obtenerUsuariosSeguidos(usuarioP) {
  const result = await connection.query(
    "SELECT usuarioS_id FROM Seguimientos WHERE usuarioP_id = ?",
    usuarioP
  );
  return result[0];
}

module.exports = {
  seguirUsuario,
  obtenerUsuariosSeguidos,
};
