(function() {
    var terrainSize = 5,
        initialPositionX = 3,
        initialPositionY = 1,
        initialOrientation = "E",
        directions = "DAAGAADAADAGGA",
        directionsList = ["N", "E", "S", "W"];

    function testIfOut() {
        if (
            (initialPositionX === 4 && initialOrientation === "E") ||
            (initialPositionX === 0 && initialOrientation === "W") ||
            (initialPositionY === 4 && initialOrientation === "S") ||
            (initialPositionY === 0 && initialOrientation === "N")
        )
            return false;
        else
            return true;
    }

    function turn(left) {
        var mouvement = left ? -1 : 1,
            index = directionsList.indexOf(initialOrientation);

        if (index != -1) {
            index += mouvement;
            if (index == 4)
                index = 0;
            else if (index == -1)
                index = 3;
            initialOrientation = directionsList[index];
        }

    }

    function move() {
        switch (initialOrientation) {
            case "N":
                initialPositionY -= 1;
                break;
            case "E":
                initialPositionX += 1;
                break;
            case "S":
                initialPositionY += 1;
                break;
            case "W":
                initialPositionX -= 1;
                break;
            default:
                break;
        }
    }

    var splitDirection = directions.split("");
    splitDirection.forEach(function(direction) {
        switch (direction) {
            case "G":
                turn(true);
                break;
            case "D":
                turn(false);
                break;
            case "A":
                if (testIfOut())
                    move();
                break;
            default:
                break;
        }
    });

    console.log("x : " + initialPositionX + ", y : " + initialPositionY + ", orientation: " + initialOrientation);
    alert("x : " + initialPositionX + ", y : " + initialPositionY + ", orientation: " + initialOrientation);
})();