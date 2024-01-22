const mysql = require('mysql2');

const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'turisticos',
  // Add other connection parameters as needed
  authPlugins: {
    mysql_clear_password: () => () => Buffer.from('turistico')
  }
});

function autenticarUsuario(usuario, contraseña, callback) {
    connection.query('SELECT * FROM usuario WHERE usuario = ? AND contrasena = ?', [usuario, contraseña], (queryErr, results) => {
        if (queryErr) {
            console.error('Error executing SELECT query:', queryErr.message);
            callback({ error: true, mensaje: 'Error en la autenticación' });
            return;
        }

        if (results.length > 0) {
            // Autenticación exitosa
            callback({ error: false, mensaje: 'Autenticación exitosa' });
        } else {
            // Credenciales incorrectas
            callback({ error: true, mensaje: 'Credenciales incorrectas' });
        }
    });
}

module.exports = autenticarUsuario;
