CREATE TABLE `tb_usuarios` (
    'ID'  INT NOT NULL,
  `CORREOE` varchar(80) NOT NULL,
  `CLAVE` varchar(300) DEFAULT NULL,
  `NOMBRECOMPLETO` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`CORREOE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla de usuarios del sistema de inscripciones';


INSERT INTO `tb_usuarios` (`ID`, `CORREOE`, `CLAVE`, `NOMBRECOMPLETO`) VALUES
(1, 'erickffuentes1@gmail.com', '123', 'Erick Fuentes'),
(2, 'erick1@hotmail.com', '246', 'Vivo VIVO')