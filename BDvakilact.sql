Create DATABASE DBvakilact;
USE DBvakilact;

create table SEDES (
   ID_SEDE              varchar(7)           not null,
   DIRECCION            varchar(70)          null,
   DISTRITO             varchar(20)          null,
   CIUDAD               varchar(20)          null,
   NOMBRE               varchar(20)          null,
   constraint PK_SEDES primary key (ID_SEDE)
)

create table ADMINISTRADORES (
   ID_ADMIN             varchar(7)           not null,
   ID_SEDE              varchar(7)           null,
   DNI_RUC              int                  null, /*correguir aqui*/
   NOMBRE               varchar(20)          null,
   APELLIDO_P           varchar(20)          null,
   APELLIDO_M           varchar(20)          null,
   PUESTO               varchar(27)          null,
   CORREO               varchar(100)          null,
   TELEFONO             int                  null,
   FECHA_REGISTRO       date                 null,
   FECHA_SALIDA         date                 null,
   constraint PK_ADMINISTRADORES primary key (ID_ADMIN),
   constraint FK_ADMINIST_REFERENCE_SEDES foreign key (ID_SEDE)
      references SEDES (ID_SEDE)
)

create table CLIENTES (
   ID_CLIENTE           varchar(7)            not null,
   ID_SEDE              varchar(7)           null,
   NOMBRE               varchar(100)          null,
   DNI_RUC              int                  null,
   CORREO               varchar(70)          null,
   TELEFONO             int                  null,
   FECHA_REGISTRO       date                 null,
   constraint PK_CLIENTES primary key (ID_CLIENTE),
   constraint FK_CLIENTES_REFERENCE_SEDES foreign key (ID_SEDE)
      references SEDES (ID_SEDE)
)

create table PRODUCTOS_TERMINADOS (
   ID_PRODUCTO          int                  not null,
   FECHA_REGISTRO       date                 null,
   NOMBRE               varchar(20)          null,
   UNIDAD_MEDIDA        varchar(17)          null,
   CARACTERISTICAS      varchar(100)         null,
   STOCK                int                  null,
   constraint PK_PRODUCTOS_TERMINADOS primary key (ID_PRODUCTO)
)

create table INGRESO_PRODT (
   ID_INGRESO           int                  not null,
   ID_PRODUCTO          int                  null,
   ID_SEDE              varchar(7)           null,
   NOMBRE               varchar(20)          null,
   CANTIDAD             int                  null,
   PRECIO_COMPRA        int                  null,
   PRECIO_VENTAMAX      int                  null,
   PRECIO_VENTAMIN      int                  null,
   FECHA_REGISTRO       date                 null,
   constraint PK_INGRESO_PRODT primary key (ID_INGRESO),
   constraint FK_INGRESO__REFERENCE_PRODUCTO foreign key (ID_PRODUCTO)
      references PRODUCTOS_TERMINADOS (ID_PRODUCTO),
   constraint FK_INGRESO__REFERENCE_SEDES foreign key (ID_SEDE)
      references SEDES (ID_SEDE)
)

create table INSUMOS (
   ID_INSUMO             varchar(7)           not null,
   ID_SEDE              varchar(7)           null,
   NOMBRE_PRODCUTO      varchar(20)          null,
   PRECIO_COMPRA        int                  null,
   PRECIO_VENTA         int                  null,
   CANTIDAD             int                  null,
   UNIDAD_MEDIDA        varchar(17)          null,
   PROVEEDOR            varchar(20)          null,
   STOCK                int                  null,
   constraint PK_INSUMOS primary key (ID_INSUMO),
   constraint FK_INSUMOS_REFERENCE_SEDES foreign key (ID_SEDE)
      references SEDES (ID_SEDE)
)

create table PROVEEDORES (
   ID_PROVEDOR          varchar(7)           not null,
   RUC                  int                  null,
   RAZON_SOCIAL         varchar(17)          null,
   NOMBRE_CONTACTO      varchar(10)          null,
   TELEFONO             int                  null,
   DIRECCION            varchar(70)          null,
   CORREO               varchar(70)          null,
   constraint PK_PROVEEDORES primary key (ID_PROVEDOR)
)

create table PEDIDOS_CABECERA (
   ID_PEDIDO            varchar(7)           not null,
   ID_SEDE              varchar(7)           null,
   ID_PROVEDOR          varchar(7)           null,
   FECHA                date                 null,
   TOTAL                int                  null,
   constraint PK_PEDIDOS_CABECERA primary key (ID_PEDIDO),
   constraint FK_PEDIDOS__REFERENCE_SEDES foreign key (ID_SEDE)
      references SEDES (ID_SEDE),
   constraint FK_PEDIDOS__REFERENCE_PROVEEDO foreign key (ID_PROVEDOR)
      references PROVEEDORES (ID_PROVEDOR)
)

create table PEDIDOS_CUERPO (
   ID_PEDIDO            varchar(7)           not null,
   ID_INSUMO             varchar(7)           not null,
   CANTIDAD             int                  null,
   PRECIO               int                  null,
   PRECIO_TOTAL         int                  null,
   constraint PK_PEDIDOS_CUERPO primary key (ID_PEDIDO, ID_INSUMO),
   constraint FK_PEDIDOS__REFERENCE_PEDIDOS_ foreign key (ID_PEDIDO)
      references PEDIDOS_CABECERA (ID_PEDIDO),
   constraint FK_PEDIDOS__REFERENCE_INSUMOS foreign key (ID_INSUMO)
      references INSUMOS (ID_INSUMO)
)

create table VENDEDOR (
   ID_EMPLEADO          varchar(7)           not null,
   ID_SEDE              varchar(7)           null,
   DNI                  int                  null,
   NOMBRE               varchar(10)          null,
   APELLIDO_P           varchar(10)          null,
   APELLIDO_M           varchar(10)          null,
   PUESTO               varchar(17)          null,
   CORREO               varchar(70)          null,
   TELEFONO             int                  null,
   FECHA_REGISTRO       date                 null,
   FECHA_SALIDA         date                DEFAULT null,
   constraint PK_VENDEDOR primary key (ID_EMPLEADO),
   constraint FK_VENDEDOR_REFERENCE_SEDES foreign key (ID_SEDE)
      references SEDES (ID_SEDE)
)

create table VENTA_CABECERA (
   ID_VENTA             varchar(7)           not null,
   ID_SEDE              varchar(7)           null,
   ID_CLIENTE           varchar(7)           null,
   ID_EMPELADO          varchar(7)           null,
   ID_ADMIN             varchar(7)           null,
   FECHA                date                 null,
   constraint PK_VENTA_CABECERA primary key (ID_VENTA),
   constraint FK_VENTA_CA_REFERENCE_SEDES foreign key (ID_SEDE)
      references SEDES (ID_SEDE),
   constraint FK_VENTA_CA_REFERENCE_CLIENTES foreign key (ID_CLIENTE)
      references CLIENTES (ID_CLIENTE),
   constraint FK_VENTA_CA_REFERENCE_VENDEDOR foreign key (ID_EMPELADO)
      references VENDEDOR (ID_EMPLEADO),
   constraint FK_VENTA_CA_REFERENCE_ADMINIST foreign key (ID_ADMIN)
      references ADMINISTRADORES (ID_ADMIN)
)

create table VENTA_CUERPO (
   ID_VENTA             varchar(7)           not null,
   ID_PRODUCTO          int                  not null,
   CANTIDAD             int                  null,
   PRECIO               int                  null,
   PRECIO_TOTAL         int                  null,
   constraint PK_VENTA_CUERPO primary key (ID_VENTA, ID_PRODUCTO),
   constraint FK_VENTA_CU_REFERENCE_VENTA_CA foreign key (ID_VENTA)
      references VENTA_CABECERA (ID_VENTA),
   constraint FK_VENTA_CU_REFERENCE_PRODUCTO foreign key (ID_PRODUCTO)
      references PRODUCTOS_TERMINADOS (ID_PRODUCTO)
)
go