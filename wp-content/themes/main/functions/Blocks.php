<?php
class Blocks {
    public array $block;
	public string $block_name;
	public string $block_id;
	public string $block_class;

	public int $post_id;
	public string $post_type;
    public object $post;

	public bool $is_preview;
	public bool $has_errors;

	public function __construct( $block, $context, $is_preview ) {
		$this->block = $block;

		$this->block_name  = $this->get_block_name();
		$this->block_id    = $this->get_id();
		$this->block_class = $this->get_class_name();

		$this->post_id   = $context['postId'];
		$this->post_type = $context['postType'];
        $this->post = $this->get_global_post();

		$this->is_preview = $is_preview;
		$this->has_errors = $this->has_errors();
	}

	public function error_template() {
		if ( $this->is_preview ) : ?>
            <section class="max-w-3xl mx-auto px-12 py-8 border border-red-300 rounded-sm bg-red-50 text-red-900">
                <h2 class="font-sans font-medium text-lg"><?= __( 'Fejl' ) ?></h2>
                <p class="font-sans text-sm leading-loose"><?= __( 'Følgende felter mangler at blive udfyldt:' ) ?></p>
                <ul class="list-disc list-inside ml-4">
					<?php foreach ( $this->valid_fields() as $error ) : ?>
                        <li class="font-sans text-sm font-medium leading-loose"><?= $error['label'] ?></li>
					<?php endforeach; ?>
                </ul>
                <p class="font-sans text-sm leading-loose"><?= __( 'Denne block vil ikke blive vist offentligt.' ) ?></p>
            </section>
		<?php endif;
	}

	protected function get_block_name(): string {
		$array = explode( '/', $this->block['name'] );

		return end( $array );
	}

	protected function get_id(): string {
		$id = $this->block_name . '-' . $this->block['id'];
		if ( ! empty( $this->block['anchor'] ) ) {
			$id = $this->block['anchor'];
		}

		return $id;
	}

	protected function get_class_name(): string {
		$class_name = $this->block_name . '-block';
		if ( ! empty( $this->block['class_name'] ) ) {
			$class_name .= ' ' . $this->block['class_name'];
		}

		return $class_name;
	}

	protected function has_errors() {
		if ( empty( $this->valid_fields() ) ) {
			return false;
		}

		if ( $this->is_preview ) {
			return true;
		}

		return false;
	}

	protected function valid_fields(): array {
        if(!get_field_objects()){
            return [];
        }

		$fields_with_required = array_filter( get_field_objects(), function ( $entry ) {
			return isset( $entry['required'] ) && $entry['required'] === 1;
		} );

		$has_error = array_filter( $fields_with_required, function ( $field ) {
			return isset( $field['value'] ) && empty( $field['value'] );
		} );

		return $has_error;
	}

    protected function get_global_post(){
        global $post;
        return $post;
    }

}