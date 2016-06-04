function Point(x,y)
{
  this.x = x;
  this.y = y;
  
  this.dist = function(other) {
    var x = this.x - other.x;
	var y = this.y - other.y;
	return Math.sqrt(x*x + y*y);
  }

  this.sub = function(other) {
    var x = this.x - other.x;
    var y = this.y - other.y;
	return new Point(x, y);
  }  
  this.add = function(other) {
    var x = this.x + other.x;
    var y = this.y + other.y;
	return new Point(x, y);
  }

  this.mulS = function(by) {
    var x = this.x * by;
    var y = this.y * by;
	return new Point(x, y);
  }

  this.norm = function() {
    var len = this.dist(new Point(0, 0));
    var x = this.x / len;
    var y = this.y / len;
	return new Point(x, y);
  }
  
  
  return this;
}

function empty_drawing(name)
{
 return { translation: new Point(0,0)
        , fillStyle:   '#ffffff'
        , rotation:    0
        , prechildren: []
        , children:    []
        , curvature:   0.1
        , points:      null
        , name:        name };
}

function child_drawing(name, children)
{
    var c = empty_drawing(name);
    c.children = children;
    return c;
}

function rect_points(ul, dr)
{
    return  [ ul
            , new Point(dr.x, ul.y)
            , dr
            , new Point(ul.x, dr.y) ];
}

function draw(ctx, obj)
{
	ctx.fillStyle = obj.fillStyle;
	var translation = obj.translation;
	var rotation    = obj.rotation;
	ctx.translate(translation.x, translation.y);
	ctx.rotate(rotation);

	var children = obj.prechildren;
	if (children) {
		for (var i = 0; i != children.length; ++i) {
			draw(ctx, children[i]);
		}
	}
	
	ctx.beginPath();
	if (obj.points) {
		closed_curve(ctx, obj.points, obj.curvature);

        ctx.fill();
        ctx.stroke();
	}
	
	var children = obj.children;
	if (children) {
		for (var i = 0; i != children.length; ++i) {
			draw(ctx, children[i]);
		}
	}

	ctx.rotate(-rotation);
	ctx.translate(-translation.x, -translation.y);
}


function closed_curve(ctx, pts, curvature)
{
  ctx.moveTo(pts[0].x, pts[0].y);
  for (var i = 0; i < pts.length; i++) {
    var ix_cp1   = (i + pts.length - 1) % pts.length;
	var ix_pen   =  i      % pts.length;
    var ix_end   = (i + 1) % pts.length;
    var ix_cp2   = (i + 2) % pts.length;
	
	var pen = pts[ix_pen];
	var end = pts[ix_end];

	var dist= pen.dist(end);
	
	var cp1 = pen.sub( pts[ix_cp1].sub(pen).norm().mulS(curvature*dist) );
	var cp2 = end.sub( pts[ix_cp2].sub(end).norm().mulS(curvature*dist) );

    ctx.bezierCurveTo(cp1.x, cp1.y, cp2.x, cp2.y, end.x, end.y);
  }
}


