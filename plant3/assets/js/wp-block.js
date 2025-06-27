// Modify Blocks Settings
// https://wptips.dev/change-gutenberg-alignment/

wp.hooks.addFilter('blocks.registerBlockType', 'plant/change_alignment', (settings, name) => {
  switch (name) {
    case 'acf/post-grid':
      return lodash.assign({}, settings, {
        supports: lodash.assign({}, settings.supports, {
          align: ['wide'],
        }),
        attributes: lodash.assign({}, settings.attributes, {
          align: {
            type: 'string',
            default: 'wide',
          },
        }),
      });
  }

  return settings;
});
