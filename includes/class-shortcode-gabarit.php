<?php

class ShortCode_Gabarit
{

    public function __construct()
    {
        add_shortcode('gb_taxonomy', array($this, 'gb_taxonomy_cb'));
        add_shortcode('gb_titre', array($this, 'gb_titre_cb'));
        add_shortcode('gb_categorie', array($this, 'gb_categorie_cb'));
        add_shortcode('gb_image_a_la_une', array($this, 'gb_image_a_la_une_cb'));
        add_shortcode('gb_auteur', array($this, 'gb_auteur_cb'));
        add_shortcode('gb_date', array($this, 'gb_date_cb'));
        add_shortcode('gb_lien', array($this, 'gb_lien_cb'));
        add_shortcode('gb_extrait', array($this, 'gb_extrait_cb'));
        add_shortcode('gb_champ_perso', array($this, 'gb_champ_perso_cb'));
    }

    public function gb_champ_perso_cb($atts = []) {
        $a = shortcode_atts(array(
            'id' => '',
        ), $atts);

        if(isset($a['id'])) {
            return get_post_meta(get_the_ID(), $a['id'], true);
        }
    }

    public function gb_taxonomy_cb($atts = [])
    {
        $a = shortcode_atts(array(
            'tax' => '',
            'lien' => ''
        ), $atts);
        $terms = get_the_terms(get_the_ID(), $a['tax']);
        if ($terms) {
            foreach ($terms as $term) {
                $link = get_term_link($term);
                $name = $term->name;
                if ($a['lien'] == 'oui') {
                    return '<a href="' . $link . '">' . $name . '</a>';
                } else {
                    return $name;
                }
            }
        }
    }


    public function gb_titre_cb()
    {
        return get_the_title();
    }



    public function gb_categorie_cb($atts = [], $content = null)
    {
        $a = shortcode_atts(array(
            'lien' => '',
        ), $atts);
        $categories = get_the_category(get_the_ID());
        if ($categories) {
            foreach ($categories as $category) {
                $link = get_category_link($category);
                $name = $category->cat_name;
                if ($a['lien'] == 'oui') {
                    return '<a href="' . $link . '">' . $name . '</a>';
                } else {
                    return $name;
                }
            }
        }
    }


    public function gb_image_a_la_une_cb()
    {
        return get_the_post_thumbnail(get_the_ID(), 'full');
    }



    public function gb_auteur_cb()
    {
        global $post;
        $a_id = $post->post_author;
        return get_the_author_meta('user_nicename', $a_id);
    }


    public function gb_date_cb()
    {
        return get_the_date();
    }



    public function gb_lien_cb()
    {
        return get_the_permalink(get_the_ID());
    }


    public function gb_extrait_cb($atts = [])
    {
        $a = shortcode_atts(array(
            'mots' => '',
        ), $atts);
        $excerpt = get_the_excerpt();
        if (isset($a['mots']) && !empty($a['mots'])) {
            $return = wp_trim_words($excerpt, $a['mots']);
        } else {
            $return = $excerpt;
        }
        return $return;
    }
}