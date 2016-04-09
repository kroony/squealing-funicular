/* very questionable, very not-random number generator */
function Randy(outer_seed)
{
    this.produce = function(inner_seed, lo, hi) {
        var full_seed = outer_seed * inner_seed + outer_seed;

        var to = Math.sin(full_seed);
        var diff = lo - hi;
        var avg  = (lo + hi) / 2;

        return to * (diff / 2) + avg;
        
    };

    return this;
}
