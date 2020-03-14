class Map01 extends Phaser.Scene {
    constructor() {
        super("Map01"); //Nombre que identifica la escena
        console.log(assets);
    }

   

    preload() {
        this.load.image("avatar", assets.avatar);

        //textura del tilemap
        this.load.image('tiles', assets.mapatileset);

        // map in json format
        this.load.tilemapTiledJSON('map', assets.mapa);

    }

    create() {
        this.add.image(100, 100, "avatar");

        //Creando objeto tilemap con el objeto json
        var map = this.make.tilemap({
            key: 'map'
        });

        //Creando imagen de tilesset spritesheet: name del tileset definido en editor Tiled

        //spritesheet: name del tileset definido en editor Tiled
        var tiles = map.addTilesetImage('terrain_atlas', 'tiles');

        //Nombres de las capas definidas en el editor Tiled
        var base = map.createStaticLayer('capa_base', tiles, 0, 0);
        var bordes = map.createStaticLayer('capa_bordes', tiles, 0, 0);
        var adornos = map.createStaticLayer('capa_adornos', tiles, 0, 0);

        //Definir que todos los tiles en este layer son objetos de colision
        //bordes.setCollisionByExclusion([-1]);

        // this.add.image(0, 0, 'map').setOrigin(0);

        //hacer que la camara siga al jugador
        //    this.cameras.main.setBounds(0, 0, map.widthInPixels, map.heightInPixels);
        //   this.cameras.main.startFollow(this.player);
        //   this.cameras.main.roundPixels = true;

        this.cameras.main.setBounds(0, 0, map.widthInPixels, map.heightInPixels);
        this.cameras.main.setZoom(1);
        this.cameras.main.centerOn(0, 0);


        /*
        if (pointer.isDown) {
            var x = pointer.x;
            var y = pointer.y;

            cam.pan(x, y, 300, 'Power2');

            console.log('X: ' +x+' '+'Y: '+y);
            

            
        }*/

        /*this.input.on('pointerdown', function () {
            var pointer = this.input.activePointer;
            var cam = this.cameras.main;

            var x = pointer.x;
            var y = pointer.y;


            //cam.pan(x, y, 300, 'Power2');
            cam.pan(x, y, 300, 'Linear');


            //300 velocidad del zoom (mientras menor mas rapido)


        }, this);*/



       /* var zoomlevel = 1;

        this.input.on('wheel', function (pointer, currentlyOver, dx, dy, dz, event) {
            var cam = this.cameras.main;

            if (dy > 0) {

                zoomlevel = zoomlevel - 1;
            }

            if (dy < 0) {
                zoomlevel = zoomlevel + 1;
            }

            if (zoomlevel <= 0) {
                zoomlevel = 1;
            }
            cam.zoomTo(zoomlevel, 300);
            console.log('dX: ' + dx + ' ' + ' dY: ' + dy + ' dZ: ' + dz + " Zoom Level: " + zoomlevel);

        });*/

        //Entradas de teclado
        this.cursors = this.input.keyboard.createCursorKeys();
        


    }

     update() {

        var cam = this.cameras.main;

        if (this.cursors.up.isDown)
        {
            if (cam.y>0) 
            cam.y -= 4;
        }
        else if (this.cursors.down.isDown)
        {
            if (cam.y<1020)
            cam.y += 4;
        }
    
        if (this.cursors.left.isDown)
        {
            cam.x -= 4;
        }
        else if (this.cursors.right.isDown)
        {
            cam.x += 4;
        }
    
    }







}