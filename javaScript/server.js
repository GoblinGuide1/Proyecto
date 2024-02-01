const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors'); // Agrega esta línea
const autenticarUsuario = require('./Conexion');

const app = express();
const port = 3000;

app.use(bodyParser.urlencoded({ extended: true }));
app.use(cors()); // Agrega esta línea para permitir CORS

app.post('/auth', (req, res) => {
    const usuario = req.body.NombeU;
    const contraseña = req.body.password;

    autenticarUsuario(usuario, contraseña, (respuesta) => {
        if (respuesta.error) {
            res.status(401).json(respuesta);
        } else {
            res.status(200).json(respuesta);
        }
    });
});

app.listen(port, () => {
    console.log(`Servidor escuchando en http://localhost:${port}`);
});
