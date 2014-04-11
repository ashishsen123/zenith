<?php return array(

/* Framework Admin Menu */
'menu' => array(
    'portfolio' => array(
        'name' => 'Portfolio Options'
    )
),

/* Framework Admin Options */
'portfolio' => array(
    array("type"  => "preheader",
          "name"  => "Permalinks",
          "desc"  => array(
              'Here you can edit urls for Portfolio post type. Don\'t forget to flush rules after changing them.',
              'After changes there open <a href="' . admin_url( 'options-permalink.php' ) . '">Permalinks</a> and hit <b>Save Options</b>.'
          )),

    array("name"  => "Portfolio item slug",
          "id"    => "portfolio_root",
          "std"   => "project",
          "desc"  => sprintf( '<strong>%s</strong>', home_url( option::get( 'portfolio_root' ) ) ),
          "type"  => "text"),

    array("name"  => "Portfolio taxonomy slug",
          "id"    => "portfolio_base",
          "std"   => "",
          "desc"  => sprintf( '<strong>%s%s</strong>', home_url( trailingslashit( option::get( 'portfolio_root' ) . '/' . option::get( 'portfolio_base' ) ) ), '%portfolio%' ),
          "type"  => "text"),

)

);