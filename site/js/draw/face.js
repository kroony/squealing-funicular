
function make_eye(opts, left)
{
	var eye_height_top = opts.top_height * opts.eye_top_ratio;
	var eye_height_bot = opts.top_height * opts.eye_bot_ratio;
	var eye_width_in = opts.eye_width_inner_ratio * opts.mid_width;
	var eye_width_out = opts.eye_width_outer_ratio * opts.mid_width;
	
	
	var eye_height_mid = (eye_height_top + eye_height_bot) / 2;
	eye_height_top = eye_height_mid - eye_height_top;
	eye_height_bot = eye_height_mid - eye_height_bot;

	var eye_width_mid = (eye_width_in + eye_width_out) / 2;
	eye_width_in = eye_width_mid - eye_width_in;
	eye_width_out = eye_width_mid - eye_width_out;

	var pts = rect_points(new Point(left*eye_width_in,  eye_height_top)
			            , new Point(left*eye_width_out, eye_height_bot));


    var c = empty_drawing('Eye');

    c.fillStyle   = opts.eye_fill;
    c.points      = pts;
	c.rotation    = left * 0.1;
    c.translation = new Point(left*eye_width_mid, -eye_height_mid);
    c.curvature   = 0.2;

    return c;
}

function make_mouth(opts)
{
	var m_height_top = opts.top_height * opts.mouth_top_ratio;
	var m_height_bot = opts.top_height * opts.mouth_bot_ratio;
	var m_width_in = opts.mouth_width_inner_ratio * opts.mid_width;
	var m_width_out = opts.mouth_width_outer_ratio * opts.mid_width;
	var pts = rect_points(new Point(m_width_in,  -m_height_top)
			            , new Point(m_width_out,  -m_height_bot));

    var c = empty_drawing('Mouth');

    c.fillStyle = opts.mouth_fill;
    c.points    = pts;
    c.curvature = 0.2;

    return c;
}

function randy(seed, min, max)
{
	var ms = new Date().getTime();
	var to = Math.sin(ms*40 / seed + seed);
	var diff = max - min;
	var avg  = (min + max) / 2;
	
	return to * (diff / 2) + avg;
}


function make_head(opts)
{
    var c = empty_drawing('Head');
    var mid_height = opts.top_height * opts.mid_ratio;
    c.children = [ make_eye(opts, 1), make_eye(opts, -1), make_mouth(opts) ];

    var ms = new Date().getTime();

    c.points    = [ new Point(-opts.top_width / 2, -opts.top_height)
				  , new Point(opts.top_width / 2,  -opts.top_height)
				  , new Point(opts.mid_width / 2,  -mid_height)
				  , new Point(opts.bot_width / 2,  0)
				  , new Point(-opts.bot_width / 2,  0)
				  , new Point(-opts.mid_width / 2,  -mid_height) ];

    c.fillStyle = opts.head_fill;
    c.rotation  = Math.sin(ms / 500) * 0.10;
    c.curvature = Math.sin(ms / 800) * 0.05 + 0.3;

    return c;
}

function make_neck(opts)
{
    var wid = Math.max(opts.bot_width, opts.mid_width);
    var points = rect_points( new Point(-wid / 2, 100)
                            , new Point(wid / 2,   -5));

    var c = empty_drawing('Neck');
    c.fillStyle = opts.head_fill;
    c.curvature = 0.2;
    c.points    = points;

	return c;
}

function make_body(opts)
{
    return child_drawing("Body",
            [ make_neck(opts), make_head(opts) ]);
}


function make_head_opts()
{

  var opts =
 { head_fill: "#C09FAF" // "#448833"
 , top_height: randy(12367, 50, 100)
 , top_width: randy(12361, 5, 25)

 , mid_ratio: randy(4655, 0.2, 0.8)
 , mid_width: randy(2351, 10, 30)

 , eye_fill: "#F0E5E0"
 , eye_line_width: 1
 , eye_top_ratio: randy(12353, 0.6, 0.9)
 , eye_bot_ratio: randy(78934, 0.4, 0.7)
 , eye_width_inner_ratio: randy(213578, 0.2, 0.5)
 , eye_width_outer_ratio: randy(5789, 0.1, 0.4)

 , mouth_fill: "#AA2233"
 , mouth_line_width: 2
 , mouth_top_ratio: randy(45789, 0.1, 0.3)
 , mouth_bot_ratio: randy(2378, 0.1, 0.3)
 , mouth_width_inner_ratio: randy(35781, -0.6, -0.3)
 , mouth_width_outer_ratio: randy(37890, 0.3, 0.6)

 , bot_width: randy(34789, 5, 25)
 , curvature: 0.2
 }
  return opts;
}


