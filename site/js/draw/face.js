
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
	c.rotation    = left * opts.eye_rotation;
    c.translation = new Point(left*eye_width_mid, -eye_height_mid);
    c.curvature   = opts.curvature;

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
    c.curvature = opts.curvature;

    return c;
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
    c.rotation  = Math.sin(ms / opts.head_bob_speed) * 0.10;
    c.curvature = opts.curvature + Math.sin(ms / opts.head_breathe_speed) * opts.curvature * 0.1;

    return c;
}

function make_neck(opts)
{
    var wid = Math.max(opts.bot_width, opts.mid_width);
    var points = rect_points( new Point(-wid / 2, 100)
                            , new Point(wid / 2,   -5));

    var c = empty_drawing('Neck');
    c.fillStyle = opts.head_fill;
    c.curvature = opts.curvature;
    c.points    = points;

	return c;
}

function make_body(opts)
{
    return child_drawing("Body",
            [ make_neck(opts), make_head(opts) ]);
}


function make_head_opts(hero_id, hero_race)
{
    var randy = new Randy(hero_id);
    var opts =
    { head_fill: "C09FAF"
    , top_height: randy.produce(12367, 50, 100)
    , top_width: randy.produce(12361, 5, 25)

    , mid_ratio: randy.produce(4655, 0.2, 0.8)
    , mid_width: randy.produce(2351, 10, 30)

    , eye_fill: "#F0E5E0"
    , eye_line_width: 1
    , eye_top_ratio: randy.produce(12353, 0.6, 0.9)
    , eye_bot_ratio: randy.produce(78934, 0.4, 0.7)
    , eye_width_inner_ratio: randy.produce(213578, 0.2, 0.5)
    , eye_width_outer_ratio: randy.produce(5789, 0.1, 0.4)

    , mouth_fill: "#AA2233"
    , mouth_line_width: 2
    , mouth_top_ratio: randy.produce(45789, 0.1, 0.3)
    , mouth_bot_ratio: randy.produce(2378, 0.1, 0.3)
    , mouth_width_inner_ratio: randy.produce(35781, -0.6, -0.3)
    , mouth_width_outer_ratio: randy.produce(37890, 0.3, 0.6)

    , bot_width: randy.produce(34789, 5, 25)
    , curvature: 0.2
    , eye_rotation: 0.1
    
    , head_bob_speed: randy.produce(432789, 400, 800)
    , head_breathe_speed: randy.produce(79834, 400, 800)
    }

    if (hero_race == "Human") {
        opts.head_fill = "#C0A0AF";
    } else if (hero_race == "Dwarf") {
        opts.head_fill = "#90807F";
        opts.curvature = 0.4;
        opts.eye_rotation = 0.0;
        opts.eye_width_outer_ratio += 0.2;
    } else if (hero_race == "Elf") {
        opts.head_fill = "#C0CB7F";
        opts.curvature = 0.1;
        opts.eye_rotation = 0.5;
        opts.mouth_line_width = 1;
    } else if (hero_race == "Halfling") {
        opts.head_fill = "#B0AB7F";
        opts.curvature = 0.2;
        opts.eye_rotation = 0.2;
    }

 
  return opts;
}


