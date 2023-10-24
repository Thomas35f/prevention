<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mobility Eduction with Dashcam</title>
    <meta  name="description"  content="Swagger UI MED"
    />
    <title>Mobility Education with Dashcam - MED</title>
    <link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist@4.5.0/swagger-ui.css" />
</head>
<body>
<div id="swagger-ui"></div>
<script src="https://unpkg.com/swagger-ui-dist@4.5.0/swagger-ui-bundle.js" crossorigin></script>
<!-- Load the HierarchicalTags Plugin -->
<script src="https://unpkg.com/swagger-ui-plugin-hierarchical-tags"></script>
<script>
    window.onload = () => {
        window.ui = SwaggerUIBundle({
            url: '{{ env('VITE_OPENAPI_URL') }}',
            dom_id: '#swagger-ui',
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIBundle.SwaggerUIStandalonePreset
            ],
            plugins: [
                HierarchicalTagsPlugin
            ]
        });
    };
</script>
</body>
</html>
