CREATE DATABASE trick_lor;

USE trick_lor;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = 'Asia/Ho_Chi_Minh';

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `slug` varchar(100) NOT NULL,
  `icon` text DEFAULT NULL,
  `icon_color` text DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `icon_color`, `active`, `created_at`, `updated_at`) VALUES
(1, 'HTML', 'html', '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\" style=\"color:currentColor\"><path fill=\"currentColor\" d=\"M30.713,0.501L71.717,460.42l184.006,51.078l184.515-51.15L481.287,0.501H30.713z M395.754,109.646   l-2.567,28.596l-1.128,12.681h-0.187H256h-0.197h-79.599l5.155,57.761h74.444H256h115.723h15.201l-1.377,15.146l-13.255,148.506   l-0.849,9.523L256,413.854v0.012l-0.259,0.072l-115.547-32.078l-7.903-88.566h26.098h30.526l4.016,44.986l62.82,16.965l0.052-0.014   v-0.006l62.916-16.977l6.542-73.158H256h-0.197H129.771l-13.863-155.444l-1.351-15.131h141.247H256h141.104L395.754,109.646z\"></path></svg>', '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 32 32\"><polygon points=\"5.902 27.201 3.655 2 28.345 2 26.095 27.197 15.985 30 5.902 27.201\" style=\"fill:#e44f26\"></polygon><polygon points=\"16 27.858 24.17 25.593 26.092 4.061 16 4.061 16 27.858\" style=\"fill:#f1662a\"></polygon><polygon points=\"16 13.407 11.91 13.407 11.628 10.242 16 10.242 16 7.151 15.989 7.151 8.25 7.151 8.324 7.981 9.083 16.498 16 16.498 16 13.407\" style=\"fill:#ebebeb\"></polygon><polygon points=\"16 21.434 15.986 21.438 12.544 20.509 12.324 18.044 10.651 18.044 9.221 18.044 9.654 22.896 15.986 24.654 16 24.65 16 21.434\" style=\"fill:#ebebeb\"></polygon><polygon points=\"15.989 13.407 15.989 16.498 19.795 16.498 19.437 20.507 15.989 21.437 15.989 24.653 22.326 22.896 22.372 22.374 23.098 14.237 23.174 13.407 22.341 13.407 15.989 13.407\" style=\"fill:#fff\"></polygon><polygon points=\"15.989 7.151 15.989 9.071 15.989 10.235 15.989 10.242 23.445 10.242 23.445 10.242 23.455 10.242 23.517 9.548 23.658 7.981 23.732 7.151 15.989 7.151\" style=\"fill:#fff\"></polygon></svg>', 1, '2023-08-18 20:30:17', '2023-08-18 20:30:17'),
(2, 'CSS', 'css', '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 32 32\" style=\"color:currentColor\"><path fill=\"currentColor\" d=\"M24.235 6.519l-16.47-0.004 0.266 3.277 12.653 0.002-0.319 3.394h-8.298l0.3 3.215h7.725l-0.457 4.403-3.636 1.005-3.694-1.012-0.235-2.637h-3.262l0.362 4.817 6.829 2.128 6.714-1.912 1.521-16.675zM2.879 1.004h26.242l-2.387 26.946-10.763 3.045-10.703-3.047z\"/></svg>', '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 32 32\"><polygon points=\"5.902 27.201 3.656 2 28.344 2 26.095 27.197 15.985 30 5.902 27.201\" style=\"fill:#1572b6\"/><polygon points=\"16 27.858 24.17 25.593 26.092 4.061 16 4.061 16 27.858\" style=\"fill:#33a9dc\"/><polygon points=\"16 13.191 20.09 13.191 20.372 10.026 16 10.026 16 6.935 16.011 6.935 23.75 6.935 23.676 7.764 22.917 16.282 16 16.282 16 13.191\" style=\"fill:#fff\"/><polygon points=\"16.019 21.218 16.005 21.222 12.563 20.292 12.343 17.827 10.67 17.827 9.24 17.827 9.673 22.68 16.004 24.438 16.019 24.434 16.019 21.218\" style=\"fill:#ebebeb\"/><polygon points=\"19.827 16.151 19.455 20.29 16.008 21.22 16.008 24.436 22.344 22.68 22.391 22.158 22.928 16.151 19.827 16.151\" style=\"fill:#fff\"/><polygon points=\"16.011 6.935 16.011 8.855 16.011 10.018 16.011 10.026 8.555 10.026 8.555 10.026 8.545 10.026 8.483 9.331 8.342 7.764 8.268 6.935 16.011 6.935\" style=\"fill:#ebebeb\"/><polygon points=\"16 13.191 16 15.111 16 16.274 16 16.282 12.611 16.282 12.611 16.282 12.601 16.282 12.539 15.587 12.399 14.02 12.325 13.191 16 13.191\" style=\"fill:#ebebeb\"/></svg>', 1, '2023-08-18 20:30:17', '2023-08-18 20:30:17'),
(3, 'JS', 'js', '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 32 32\" style=\"color:currentColor\"><path fill=\"currentColor\" d=\"M2 2v28h28v-28zM17.238 23.837c0 2.725-1.6 3.969-3.931 3.969-2.106 0-3.325-1.087-3.95-2.406l2.144-1.294c0.413 0.731 0.788 1.35 1.694 1.35 0.862 0 1.412-0.338 1.412-1.656v-8.944h2.631zM23.462 27.806c-2.444 0-4.025-1.162-4.794-2.688l2.144-1.237c0.563 0.919 1.3 1.6 2.594 1.6 1.087 0 1.788-0.544 1.788-1.3 0-0.9-0.713-1.219-1.919-1.75l-0.656-0.281c-1.9-0.806-3.156-1.825-3.156-3.969 0-1.975 1.506-3.475 3.85-3.475 1.675 0 2.875 0.581 3.738 2.106l-2.050 1.313c-0.45-0.806-0.938-1.125-1.694-1.125-0.768 0-1.256 0.488-1.256 1.125 0 0.788 0.488 1.106 1.619 1.6l0.656 0.281c2.238 0.956 3.494 1.938 3.494 4.137 0 2.363-1.863 3.662-4.357 3.662z\"/></svg>', '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 32 32\"><rect x=\"2\" y=\"2\" width=\"28\" height=\"28\" style=\"fill:#f5de19\"/><path d=\"M20.809,23.875a2.866,2.866,0,0,0,2.6,1.6c1.09,0,1.787-.545,1.787-1.3,0-.9-.716-1.222-1.916-1.747l-.658-.282c-1.9-.809-3.16-1.822-3.16-3.964,0-1.973,1.5-3.476,3.853-3.476a3.889,3.889,0,0,1,3.742,2.107L25,18.128A1.789,1.789,0,0,0,23.311,17a1.145,1.145,0,0,0-1.259,1.128c0,.789.489,1.109,1.618,1.6l.658.282c2.236.959,3.5,1.936,3.5,4.133,0,2.369-1.861,3.667-4.36,3.667a5.055,5.055,0,0,1-4.795-2.691Zm-9.295.228c.413.733.789,1.353,1.693,1.353.864,0,1.41-.338,1.41-1.653V14.856h2.631v8.982c0,2.724-1.6,3.964-3.929,3.964a4.085,4.085,0,0,1-3.947-2.4Z\"/></svg>', 1, '2023-08-18 20:30:17', '2023-08-18 20:30:17'),
(4, 'PHP', 'php', '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\" style=\"color:currentColor\"><path fill=\"currentColor\" d=\"M401.054,224c3.714,4.115,4.595,11.181,2.653,21.19c-2.029,10.425-5.935,17.862-11.723,22.32   c-5.793,4.458-14.602,6.687-26.432,6.687h-17.849l10.957-56.37h20.103C389.913,217.827,397.34,219.886,401.054,224z    M149.754,217.827h-20.103l-10.958,56.37h17.848c11.827,0,20.639-2.229,26.432-6.687c5.789-4.458,9.694-11.896,11.723-22.32   c1.942-10.01,1.06-17.075-2.653-21.19C168.33,219.886,160.903,217.827,149.754,217.827z M511.5,256   c0,74.229-114.393,134.403-255.5,134.403S0.5,330.229,0.5,256c0-74.228,114.393-134.403,255.5-134.403S511.5,181.772,511.5,256z    M198.542,265.286c3.04-5.448,5.203-11.461,6.483-18.037c3.102-15.967,0.761-28.403-7.024-37.313   c-7.781-8.91-20.165-13.363-37.136-13.363h-56.423L78.265,331.261h29.342l6.958-35.805h25.134c11.087,0,20.21-1.164,27.372-3.497   c7.161-2.329,13.669-6.233,19.528-11.719C191.514,275.72,195.493,270.738,198.542,265.286z M301.814,295.456l12.181-62.682   c2.479-12.747,0.619-21.971-5.572-27.664c-6.196-5.688-17.449-8.537-33.768-8.537h-25.933l6.961-35.81h-29.11l-26.182,134.692   h29.11l14.996-77.165h23.267c7.448,0,12.317,1.232,14.604,3.698c2.287,2.467,2.773,7.091,1.455,13.869l-11.581,59.598H301.814z    M427.011,209.937c-7.78-8.91-20.164-13.363-37.135-13.363h-56.424l-26.178,134.688h29.343l6.957-35.805h25.135   c11.086,0,20.21-1.164,27.371-3.497c7.161-2.329,13.669-6.233,19.528-11.719c4.92-4.521,8.896-9.502,11.943-14.954   c3.044-5.448,5.202-11.461,6.483-18.037C437.137,231.282,434.796,218.846,427.011,209.937z\"></path></svg>', '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" viewBox=\"0 0 32 32\"><defs><radialGradient id=\"a\" cx=\"-16.114\" cy=\"20.532\" r=\"18.384\" gradientTransform=\"translate(26.52 -9.307)\" gradientUnits=\"userSpaceOnUse\"><stop offset=\"0\" stop-color=\"#ffffff\"/><stop offset=\"0.5\" stop-color=\"#4c6b96\"/><stop offset=\"1\" stop-color=\"#231f20\"/></radialGradient></defs><ellipse cx=\"16\" cy=\"16\" rx=\"14\" ry=\"7.365\" style=\"fill:url(#a)\"/><ellipse cx=\"16\" cy=\"16\" rx=\"13.453\" ry=\"6.818\" style=\"fill:#6280b6\"/><path d=\"M18.725,18.2l.667-3.434a1.752,1.752,0,0,0-.372-1.719,2.929,2.929,0,0,0-2-.525H15.867l.331-1.7a.219.219,0,0,0-.215-.26h-1.6a.219.219,0,0,0-.215.177l-.709,3.646a2.051,2.051,0,0,0-.477-1.054,2.783,2.783,0,0,0-2.2-.807H7.7a.219.219,0,0,0-.215.177l-1.434,7.38a.219.219,0,0,0,.215.26H7.869a.219.219,0,0,0,.215-.177l.347-1.785h1.2a5.167,5.167,0,0,0,1.568-.2,3.068,3.068,0,0,0,1.15-.689,3.538,3.538,0,0,0,.68-.844l-.287,1.475a.219.219,0,0,0,.215.26h1.6a.219.219,0,0,0,.215-.177l.787-4.051h1.094c.466,0,.6.093.64.133s.1.165.025.569l-.635,3.265a.219.219,0,0,0,.215.26h1.62A.219.219,0,0,0,18.725,18.2ZM11.33,15.366a1.749,1.749,0,0,1-.561,1.092,2.171,2.171,0,0,1-1.315.321H8.742l.515-2.651h.921c.677,0,.949.145,1.059.266A1.181,1.181,0,0,1,11.33,15.366Z\" style=\"fill:#fff\"/><path d=\"M25.546,13.332a2.783,2.783,0,0,0-2.2-.807H20.255a.219.219,0,0,0-.215.177l-1.434,7.38a.219.219,0,0,0,.215.26h1.608a.219.219,0,0,0,.215-.177l.347-1.785h1.2a5.167,5.167,0,0,0,1.568-.2,3.068,3.068,0,0,0,1.15-.689,3.425,3.425,0,0,0,1.076-1.927A2.512,2.512,0,0,0,25.546,13.332Zm-1.667,2.034a1.749,1.749,0,0,1-.561,1.092A2.171,2.171,0,0,1,22,16.778H21.29l.515-2.651h.921c.677,0,.949.145,1.059.266A1.181,1.181,0,0,1,23.879,15.366Z\" style=\"fill:#fff\"/><path d=\"M10.178,13.908a1.645,1.645,0,0,1,1.221.338,1.34,1.34,0,0,1,.145,1.161,1.945,1.945,0,0,1-.642,1.223A2.361,2.361,0,0,1,9.454,17H8.476l.6-3.089ZM6.261,20.124H7.869l.381-1.962H9.627a4.931,4.931,0,0,0,1.5-.191,2.84,2.84,0,0,0,1.07-.642,3.207,3.207,0,0,0,1.01-1.808,2.3,2.3,0,0,0-.385-2.044,2.568,2.568,0,0,0-2.035-.732H7.7Z\" style=\"fill:#000004\"/><path d=\"M14.387,10.782h1.6L15.6,12.744h1.421a2.767,2.767,0,0,1,1.85.468,1.548,1.548,0,0,1,.305,1.516l-.667,3.434H16.89l.635-3.265a.886.886,0,0,0-.08-.76,1.121,1.121,0,0,0-.8-.2H15.37l-.822,4.228h-1.6Z\" style=\"fill:#000004\"/><path d=\"M22.727,13.908a1.645,1.645,0,0,1,1.221.338,1.34,1.34,0,0,1,.145,1.161,1.945,1.945,0,0,1-.642,1.223A2.361,2.361,0,0,1,22,17h-.978l.6-3.089ZM18.81,20.124h1.608l.381-1.962h1.377a4.931,4.931,0,0,0,1.5-.191,2.84,2.84,0,0,0,1.07-.642,3.207,3.207,0,0,0,1.01-1.808,2.3,2.3,0,0,0-.385-2.044,2.568,2.568,0,0,0-2.035-.732H20.244Z\" style=\"fill:#000004\"/></svg>', 1, '2023-08-18 20:30:17', '2023-08-18 20:30:17'),
(5, 'Python', 'python', '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\" style=\"color:currentColor\"><path fill=\"currentColor\" d=\"M194.734,246.879h121.768c33.9,0,60.956-27.908,60.956-61.95V68.846c0-33.035-27.87-57.855-60.956-63.371   c-20.943-3.484-42.673-5.069-63.51-4.971c-20.845,0.097-40.74,1.874-58.258,4.971c-51.586,9.117-60.952,28.191-60.952,63.371   v46.463H255.69v15.486H133.782h-45.75c-35.434,0-66.459,21.295-76.158,61.808c-11.192,46.435-11.694,75.409,0,123.898   c8.666,36.088,29.359,61.807,64.79,61.807h41.917v-55.699C118.581,282.37,153.39,246.879,194.734,246.879z M187.063,84.333   c-12.636,0-22.877-10.355-22.877-23.161c0-12.849,10.241-23.3,22.877-23.3c12.594,0,22.873,10.451,22.873,23.3   C209.936,73.979,199.658,84.333,187.063,84.333z M499.37,192.603c-8.761-35.27-25.484-61.808-60.96-61.808h-45.75v54.134   c0,41.972-35.582,77.292-76.158,77.292H194.734c-33.349,0-60.952,28.547-60.952,61.954v116.079   c0,33.037,28.726,52.476,60.952,61.943c38.589,11.353,75.59,13.409,121.768,0c30.688-8.876,60.956-26.764,60.956-61.943v-46.461   H255.69v-15.486h121.768h60.952c35.431,0,48.638-24.715,60.96-61.807C512.092,278.314,511.549,241.589,499.37,192.603z    M324.178,424.766c12.64,0,22.873,10.356,22.873,23.156c0,12.85-10.233,23.305-22.873,23.305   c-12.595,0-22.877-10.455-22.877-23.305C301.301,435.122,311.583,424.766,324.178,424.766z\"></path></svg>', '<svg viewBox=\"0 0 32 32\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\"><defs><linearGradient id=\"a\" x1=\"-133.268\" y1=\"-202.91\" x2=\"-133.198\" y2=\"-202.84\" gradientTransform=\"translate(25243.061 38519.17) scale(189.38 189.81)\" gradientUnits=\"userSpaceOnUse\"><stop offset=\"0\" stop-color=\"#387eb8\"/><stop offset=\"1\" stop-color=\"#366994\"/></linearGradient><linearGradient id=\"b\" x1=\"-133.575\" y1=\"-203.203\" x2=\"-133.495\" y2=\"-203.133\" gradientTransform=\"translate(25309.061 38583.42) scale(189.38 189.81)\" gradientUnits=\"userSpaceOnUse\"><stop offset=\"0\" stop-color=\"#ffe052\"/><stop offset=\"1\" stop-color=\"#ffc331\"/></linearGradient></defs><path d=\"M15.885,2.1c-7.1,0-6.651,3.07-6.651,3.07V8.36h6.752v1H6.545S2,8.8,2,16.005s4.013,6.912,4.013,6.912H8.33V19.556s-.13-4.013,3.9-4.013h6.762s3.772.06,3.772-3.652V5.8s.572-3.712-6.842-3.712h0ZM12.153,4.237a1.214,1.214,0,1,1-1.183,1.244v-.02a1.214,1.214,0,0,1,1.214-1.214h0Z\" style=\"fill:url(#a)\"/><path d=\"M16.085,29.91c7.1,0,6.651-3.08,6.651-3.08V23.65H15.985v-1h9.47S30,23.158,30,15.995s-4.013-6.912-4.013-6.912H23.64V12.4s.13,4.013-3.9,4.013H12.975S9.2,16.356,9.2,20.068V26.2s-.572,3.712,6.842,3.712h.04Zm3.732-2.147A1.214,1.214,0,1,1,21,26.519v.03a1.214,1.214,0,0,1-1.214,1.214h.03Z\" style=\"fill:url(#b)\"/></svg>', 1, '2023-08-18 20:30:17', '2023-08-18 20:30:17'),
(6, 'Java', 'java', '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\" style=\"color:currentColor\"><path fill=\"currentColor\" d=\"M193.918,208.369c-4.729-10.456-6.849-22.652-3.236-33.731c3.612-11.327,11.703-20.413,19.794-28.878   c22.525-22.531,50.285-39.085,72.316-61.986c12.197-12.573,22.278-27.634,25.762-44.937c2.864-12.695,1.496-25.764-1.117-38.337   c11.7,13.319,15.559,32.363,12.197,49.541c-3.608,19.292-14.316,36.344-26.886,51.031c-10.081,11.827-21.659,22.282-33.731,31.993   c-14.065,11.327-27.88,23.524-36.716,39.457c-7.472,12.943-9.215,28.876-4.11,42.942c8.341,24.146,27.756,42.071,38.338,64.848   c-11.703-10.332-23.152-21.036-33.86-32.361C211.471,236.001,200.889,223.307,193.918,208.369z M257.398,189.448   c-2.115,19.792,8.213,38.462,20.539,53.151c5.972,6.596,11.076,14.687,11.323,23.899c0.251,12.318-6.716,23.774-15.684,31.861   c2.119-0.246,3.612-2.115,5.355-3.11c13.443-8.589,26.385-19.418,32.982-34.227c4.357-10.083,3.362-22.034-2.362-31.371   c-6.724-10.953-15.559-20.662-20.786-32.61c-2.867-6.721-3.862-14.562-1.496-21.657c3.114-9.583,9.834-17.426,16.93-24.272   c19.54-18.544,43.189-31.743,65.844-46.179c-28.629,8.214-56.883,19.542-81.03,37.343   C273.702,153.727,259.515,169.658,257.398,189.448z M393.447,283.052c13.568,0.748,26.882,10.704,29.374,24.397   c2.366,11.825-3.358,23.524-10.705,32.485c-12.075,14.438-28.382,24.771-44.807,33.609c-1.622,0.991-2.99,2.237-4.235,3.608   c21.659-5.478,43.314-13.689,60.867-27.756c9.705-8.091,18.294-18.799,20.163-31.619c1.743-11.076-2.86-22.528-11.077-29.871   c-9.96-9.09-24.021-12.448-37.218-10.704c-7.593,0.995-15.931,2.613-21.158,8.961C380.877,284.921,386.971,282.429,393.447,283.052   z M123.22,318.647c16.303,4.357,33.108,5.603,49.787,6.724c14.936,0.995,29.875,1.246,44.937,1.12   c38.833-0.619,77.916-3.236,116.003-11.699c3.608-0.87,7.593-1.493,10.833-3.733c6.347-4.11,13.313-7.347,20.162-10.583   c-30.995,4.979-62.113,9.215-93.478,11.205c-31.74,1.991-63.731,3.236-95.593,1.121c-9.086-0.87-18.423-1.371-26.886-4.858   c-1.994-0.87-4.733-2.609-3.738-5.227c1.869-3.361,5.603-4.977,8.839-6.72c13.694-6.473,28.629-10.081,43.193-14.313   c-25.021-0.376-49.916,5.971-72.814,15.806c-5.105,2.491-10.83,4.481-14.936,8.714c-1.622,1.739-1.622,4.732,0.247,6.222   C113.511,315.787,118.487,317.28,123.22,318.647z M324.864,352.88c-21.784,3.859-43.694,7.472-65.726,8.589   c-24.147,1.618-48.294,0.247-72.191-2.241c-4.604-0.623-9.211-1.368-13.317-3.483c-2.116-1.246-4.231-3.236-4.106-5.854   c0.247-4.106,3.73-6.967,6.222-9.956c-7.715,2.739-15.434,5.599-21.906,10.708c-2.742,2.116-5.478,5.474-4.733,9.208   c1.125,4.356,5.356,6.97,9.09,8.96c9.208,4.733,19.54,6.846,29.625,8.714c25.511,4.11,51.527,4.235,77.167,2.488   c27.141-2.115,54.148-6.594,80.411-14.313C337.932,362.342,330.836,358.479,324.864,352.88z M188.068,395.951   c-6.97,1.99-14.066,4.357-19.79,8.957c-2.868,2.241-5.105,6.104-3.734,9.713c1.743,4.604,6.1,7.347,10.203,9.705   c10.708,5.854,22.78,8.589,34.604,10.708c26.765,4.229,54.27,3.608,80.908-1.12c15.806-2.989,31.615-7.221,46.301-13.815   c-9.584-3.984-18.917-8.467-27.878-13.693c-15.559,2.738-31.246,5.603-47.178,6.598c-21.032,1.618-42.319-0.125-63.355-2.738   c-4.98-1.121-11.202-1.618-14.563-5.976C181.847,400.677,185.828,398.063,188.068,395.951z M358.345,475.982   c17.424-3.604,34.977-7.719,50.908-15.806c4.976-2.867,11.076-5.979,12.698-11.95c0.87-5.725-5.105-8.714-9.337-11.08   c2.613,2.993,4.356,7.347,1.74,10.83c-4.357,5.853-11.821,8.091-18.42,10.332c-20.66,5.85-42.072,8.216-63.355,10.582   c-56.385,5.102-113.146,6.348-169.528,1.618c-18.92-1.994-38.217-4.109-56.264-10.829c-2.86-1.246-7.217-2.492-7.217-6.352   c1.117-3.354,4.357-5.227,7.217-6.845c12.945-6.595,27.384-10.207,41.822-11.077c-4.228-2.491-9.208-2.738-14.062-2.613   c-12.076,0.373-23.9,3.483-35.349,7.347c-9.834,3.604-19.916,7.59-27.76,14.811c-3.111,2.735-5.971,7.962-2.739,11.699   c4.98,5.353,12.699,6.72,19.54,8.338c38.338,6.599,77.171,10.328,116.011,11.699C255.781,488.184,307.684,485.942,358.345,475.982z    M409.378,482.706c-23.402,7.468-47.672,11.574-71.822,14.936c-41.696,5.227-83.769,6.845-125.716,5.603   c-25.515-0.995-51.03-2.738-76.176-6.974c5.85,3.984,13.071,5.227,19.794,7.096c28.257,5.976,57.255,7.096,86.01,7.966   c42.19,0.748,84.387-0.87,125.962-7.468c19.669-3.48,39.459-7.715,57.13-16.927c9.215-4.854,18.552-12.326,20.163-23.152   C435.391,473.741,421.951,478.349,409.378,482.706z\"></path></svg>', '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" viewBox=\"0 0 511.998 511.998\"><g><path style=\"fill:#db380e\" d=\"M253.464,94.869c-23.658,16.639-50.471,35.498-64.838,66.699   c-24.954,54.435,51.062,113.812,54.311,116.313c0.755,0.581,1.659,0.871,2.56,0.871c0.957,0,1.915-0.327,2.693-0.979   c1.509-1.262,1.937-3.406,1.031-5.152c-0.275-0.53-27.561-53.53-26.547-91.552c0.359-13.243,18.892-28.266,38.512-44.171   c17.97-14.568,38.34-31.079,50.258-50.394c26.164-42.516-2.916-84.322-3.213-84.74c-1.155-1.622-3.287-2.209-5.11-1.41   c-1.821,0.804-2.83,2.773-2.414,4.72c0.059,0.277,5.714,27.923-10.022,56.406C284.203,73.25,269.959,83.268,253.464,94.869z\"/><path style=\"fill:#db380e\" d=\"M353.137,113.617c1.669-1.257,2.159-3.55,1.15-5.38c-1.011-1.83-3.211-2.637-5.165-1.895   c-4.019,1.528-98.416,37.915-98.416,81.88c0,30.307,12.946,46.317,22.399,58.009c3.708,4.586,6.909,8.546,7.964,11.927   c2.97,9.743-4.066,27.353-7.025,33.317c-0.853,1.714-0.435,3.792,1.016,5.044c0.784,0.677,1.763,1.021,2.743,1.021   c0.834,0,1.672-0.248,2.396-0.752c1.623-1.128,39.667-28.026,32.844-60.433c-2.542-12.318-8.595-21.318-13.936-29.26   c-8.274-12.305-14.25-21.193-5.184-37.609C304.545,150.338,352.65,113.981,353.137,113.617z\"/></g><g><path style=\"fill:#73a1fb\" d=\"M107.418,298.236c-1.618,4.845-0.854,9.651,2.207,13.903c10.233,14.207,46.48,22.029,102.068,22.029   c0.003,0,0.005,0,0.007,0c7.532,0,15.484-0.148,23.629-0.44c88.875-3.181,121.839-30.869,123.199-32.046   c1.482-1.283,1.878-3.419,0.957-5.147c-0.922-1.727-2.909-2.595-4.808-2.072c-31.301,8.546-89.748,11.58-130.288,11.58   c-45.363,0-68.465-3.268-74.121-5.681c2.902-3.985,20.802-11.101,42.983-15.464c2.12-0.416,3.577-2.374,3.367-4.524   s-2.016-3.79-4.177-3.79C179.439,276.584,114.234,277.628,107.418,298.236z\"/><path style=\"fill:#73a1fb\" d=\"M404.812,269.718c-18.331,0-35.714,9.188-36.446,9.577c-1.695,0.908-2.555,2.852-2.09,4.72   c0.467,1.865,2.144,3.176,4.067,3.178c0.389,0,39.102,0.317,42.608,22.436c3.106,19.082-36.629,50-52.202,60.304   c-1.682,1.113-2.335,3.263-1.554,5.123c0.665,1.583,2.206,2.573,3.868,2.573c0.29,0,0.584-0.03,0.876-0.092   c3.696-0.791,90.406-19.899,81.238-70.384C439.584,276.213,420.138,269.718,404.812,269.718z\"/><path style=\"fill:#73a1fb\" d=\"M345.347,363.755c0.302-1.617-0.371-3.262-1.717-4.207l-20.791-14.563   c-1.014-0.71-2.295-0.933-3.485-0.618c-0.217,0.055-21.959,5.771-53.525,9.276c-12.528,1.405-26.56,2.147-40.582,2.147   c-31.558,0-52.192-3.708-55.197-6.428c-0.398-0.764-0.272-1.111-0.201-1.304c0.546-1.518,3.472-3.322,5.358-4.036   c2.083-0.771,3.206-3.033,2.558-5.157c-0.646-2.127-2.837-3.378-4.999-2.859c-20.856,5.033-31.054,12.071-30.312,20.918   c1.318,15.686,37.65,23.737,68.365,25.865c4.417,0.302,9.194,0.455,14.195,0.455c0.003,0,0.005,0,0.008,0   c51.074,0,116.55-16.025,117.204-16.188C343.825,366.666,345.044,365.375,345.347,363.755z\"/><path style=\"fill:#73a1fb\" d=\"M188.602,397.419c1.575-1.024,2.273-2.971,1.714-4.764c-0.557-1.793-2.234-2.971-4.118-2.946   c-2.795,0.074-27.349,1.182-29.068,16.815c-0.52,4.672,0.818,8.941,3.979,12.686c8.816,10.448,32.614,16.658,72.741,18.984   c4.747,0.285,9.569,0.428,14.334,0.428c51.015,0,85.373-15.973,86.812-16.653c1.395-0.66,2.315-2.031,2.397-3.571   s-0.687-3.001-2.003-3.806l-26.275-16.04c-0.912-0.556-2.003-0.74-3.043-0.527c-0.166,0.035-16.849,3.495-42.026,6.913   c-4.764,0.648-10.73,0.977-17.73,0.977c-25.15,0-53.124-4.109-58.489-6.8C187.749,398.613,187.848,397.975,188.602,397.419z\"/><path style=\"fill:#73a1fb\" d=\"M224.408,486.85c116.854-0.099,179.571-20.88,191.653-33.957c4.277-4.626,4.739-9.006,4.376-11.867   c-0.898-7.04-7.311-11.35-8.038-11.818c-1.754-1.128-4.108-0.833-5.476,0.745c-1.365,1.578-1.397,3.884-0.027,5.461   c0.737,0.948,1.163,2.535-0.992,4.692c-4.83,4.511-53.545,18.204-134.656,22.318c-11.111,0.577-22.765,0.871-34.636,0.873   c-72.623,0-125.772-9.948-132.749-15.744c2.689-3.864,21.489-10.037,41.482-13.529c2.253-0.393,3.775-2.516,3.426-4.776   c-0.349-2.259-2.432-3.814-4.709-3.519c-0.564,0.077-2.478,0.191-4.694,0.327c-32.988,2.014-71.109,6.503-73.098,23.5   c-0.604,5.179,0.935,9.881,4.576,13.973c8.909,10.01,34.516,23.319,153.558,23.319C224.406,486.85,224.406,486.85,224.408,486.85z\"/><path style=\"fill:#73a1fb\" d=\"M439.013,456.578c-1.652-0.764-3.604-0.378-4.836,0.952c-0.171,0.185-17.74,18.556-70.564,29.344   c-20.223,4.052-58.183,6.107-112.826,6.107c-54.745,0-106.838-2.154-107.357-2.176c-2.176-0.106-4.037,1.476-4.333,3.618   c-0.297,2.14,1.083,4.158,3.184,4.658c0.542,0.128,55.135,12.918,129.779,12.918c35.801,0,70.639-2.907,103.548-8.645   c61.361-10.757,65.657-41.183,65.81-42.473C441.632,459.078,440.662,457.342,439.013,456.578z\"/></g></svg>', 0, '2023-08-18 20:30:17', '2024-01-08 08:29:00'),
(7, 'Git', 'git', '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" style=\"color:currentColor\"><path fill=\"currentColor\" d=\"M2.6,10.59,8.38,4.8l1.69,1.7A2,2,0,0,0,11,8.73v5.54A2,2,0,0,0,10,16a2,2,0,0,0,4,0,2,2,0,0,0-1-1.73V9.41l2.07,2.09A1.17,1.17,0,0,0,15,12a2,2,0,1,0,2-2,1.17,1.17,0,0,0-.5.07L13.93,7.5a2,2,0,0,0-1.15-2.34,2.1,2.1,0,0,0-1.28-.09L9.8,3.38l.79-.78a2,2,0,0,1,2.82,0l8,8a2,2,0,0,1,0,2.82l-8,8a2,2,0,0,1-2.82,0l-8-8A2,2,0,0,1,2.6,10.59Z\"/></svg>', '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 32 32\" fill=\"none\"><path d=\"M2.58536 17.4132C1.80488 16.6327 1.80488 15.3673 2.58536 14.5868L14.5868 2.58536C15.3673 1.80488 16.6327 1.80488 17.4132 2.58536L29.4146 14.5868C30.1951 15.3673 30.1951 16.6327 29.4146 17.4132L17.4132 29.4146C16.6327 30.1951 15.3673 30.1951 14.5868 29.4146L2.58536 17.4132Z\" fill=\"#EE513B\"/><path d=\"M12.1489 5.06152L10.9336 6.27686L14.0725 9.41577C13.9455 9.68819 13.8746 9.99201 13.8746 10.3124C13.8746 11.222 14.4461 11.9981 15.2496 12.3012V19.9798C14.4461 20.2829 13.8746 21.059 13.8746 21.9686C13.8746 23.1422 14.826 24.0936 15.9996 24.0936C17.1732 24.0936 18.1246 23.1422 18.1246 21.9686C18.1246 21.144 17.6549 20.429 16.9684 20.0768V12.3117L19.9689 15.3122C19.8481 15.5791 19.7809 15.8754 19.7809 16.1874C19.7809 17.361 20.7323 18.3124 21.9059 18.3124C23.0795 18.3124 24.0309 17.361 24.0309 16.1874C24.0309 15.0138 23.0795 14.0624 21.9059 14.0624C21.6778 14.0624 21.4582 14.0983 21.2522 14.1648L18.0297 10.9423C18.0914 10.7433 18.1246 10.5317 18.1246 10.3124C18.1246 9.13878 17.1732 8.18738 15.9996 8.18738C15.7803 8.18738 15.5688 8.22061 15.3697 8.2823L12.1489 5.06152Z\" fill=\"white\"/></svg>', 0, '2023-08-19 14:37:14', '2024-01-08 08:28:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `youtube_id` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `thumbnails` text DEFAULT NULL,
  `thumbnails_custom` text DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `youtube_id`, `description`, `thumbnails`, `thumbnails_custom`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Sử dụng CSS Function calc() để Thiết lập Kích thước Phần Tử Trong Thiết kế Website', 'su-dung-css-function-calc-de-thiet-lap-kich-thuoc-phan-tu-trong-thiet-ke-website', 'uCeBJPFhj5g', '<p>CSS Function calc() là một công cụ mạnh mẽ và tiện lợi trong việc quản lý kích thước và vị trí của các phần tử trên trang web của bạn. Bài viết này sẽ giúp bạn hiểu cách sử dụng CSS Function calc() một cách hiệu quả để tạo ra các thiết kế linh hoạt và chuyên nghiệp hơn.</p>\n<h2>CSS Function calc() Là Gì?</h2>\n<p>Trước hết, hãy xem qua cú pháp cơ bản của CSS Function calc():</p>\n<pre class=\"language-css\"><code>.item {\n    width: calc(expression);\n}</code></pre>\n<div>Ở đây, <code>.item</code> là tên của phần tử bạn muốn thiết lập kích thước, và <code>expression</code> có thể là bất kỳ biểu thức tính toán nào bạn muốn. Thường thì <code>expression</code> bao gồm các toán tử cộng, trừ, nhân, chia và các giá trị (px, %) kèm theo. Ví dụ:</div>\n<div>\n<pre class=\"language-css\"><code>.item {\n    width: calc(100px + 200px);\n}</code></pre>\n<h2>Sử dụng CSS Function calc() trong Thiết kế Web</h2>\n<p>CSS Function calc() cho phép bạn thực hiện các phép tính toán trực tiếp trong khai báo CSS, giúp tạo ra những thiết kế động và thích nghi. Dưới đây là một số ví dụ cụ thể về việc sử dụng CSS Function calc() trong thiết kế web:</p>\n<h3>1. Tạo Kích thước dựa trên tính toán</h3>\n<p>Bạn có thể dễ dàng tính toán kích thước của phần tử dựa trên giá trị cố định và tính toán:</p>\n<pre class=\"language-css\"><code>.item {\n    width: calc(100px + 200px);\n}</code></pre>\n<p>Trong ví dụ này, chiều rộng của phần tử <code>.item</code> sẽ là tổng của 100px và 200px, tức là 300px.</p>\n<h3>2. Tùy chỉnh chiều rộng dựa trên phần trăm</h3>\n<p>Bạn có thể tính toán kích thước dựa trên phần trăm của kích thước parent container:</p>\n<pre class=\"language-css\"><code>.item {\n    width: calc(100% + 100px);\n}</code></pre>\n<p>Khi bạn sử dụng CSS Function calc() như vậy, <code>.item</code> sẽ có chiều rộng bằng 100% của phần tử cha cộng thêm 100px.</p>\n<h3>3. Điều chỉnh kích thước để tránh xung đột với các phần tử khác</h3>\n<p>CSS Function calc() rất hữu ích khi bạn muốn đảm bảo rằng một phần tử không xung đột với các phần tử khác trên trang web, ví dụ như một thanh điều hướng (navbar). Ví dụ:</p>\n<pre class=\"language-css\"><code>.item {\n    width: calc(100% - 80px);\n}</code></pre>\n<p>Ở đây, chiều rộng của <code>.item</code> được tính toán bằng cách lấy 100% của chiều rộng của phần tử cha trừ đi chiều rộng của thanh navbar (80px). Điều này giúp tránh tình trạng xung đột với thanh navbar.</p>\n<h2>Kết Luận</h2>\n<p>CSS Function calc() là một công cụ mạnh mẽ cho việc quản lý kích thước và vị trí của các phần tử trên trang web của bạn. Với khả năng tính toán động và linh hoạt, bạn có thể tạo ra các thiết kế web chuyên nghiệp và thích nghi dễ dàng hơn. Hãy thử sử dụng CSS Function calc() trong các dự án của bạn và khám phá sự linh hoạt mà nó mang lại!</p>\n</div>', '[\"https:\\/\\/i.ytimg.com\\/vi\\/uCeBJPFhj5g\\/mqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/uCeBJPFhj5g\\/hqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/uCeBJPFhj5g\\/maxresdefault.jpg\"]', NULL, 1, '2023-08-18 21:06:11', '2023-10-29 11:34:14'),
(2, 'Những Trick Hay Ho Trong Javascript - Phần 1', 'nhung-trick-hay-ho-trong-javascript-phan-1', '71W9f2yQQI0', '<p>Trong bài viết này, chúng ta sẽ khám phá một số trick Javascript thú vị để cải thiện khả năng lập trình của bạn.</p>\r\n<h2>1. Đổi chỗ 2 biến mà không cần biến tạm</h2>\r\n<p>Bạn có thể đổi chỗ giá trị của hai biến mà không cần sử dụng biến tạm. Điều này giúp bạn viết mã ngắn gọn hơn và dễ đọc hơn.</p>\r\n<pre class=\"language-javascript\"><code>let x = 1;\r\nlet y = 2;\r\n\r\n[x, y] = [y, x]; \r\n// Kết quả: x = 2 và y = 1</code></pre>\r\n<h2>2. Sử dụng Spread Operator</h2>\r\n<p>Spread operator (<code>...</code>) là một công cụ mạnh mẽ để làm việc với mảng và danh sách. Bạn có thể kết hợp nhiều mảng lại với nhau một cách dễ dàng.</p>\r\n<pre class=\"language-javascript\"><code>const oddNums = [1, 3, 5, 7];\r\nconst evenNums = [2, 4];\r\n\r\nconst allNums = [...oddNums, ...evenNums];\r\n// Kết quả: allNums = [1, 3, 5, 7, 2, 4]</code></pre>\r\n<h2>3. Tạo Mảng Chứa Phần Tử Không Trùng Lặp</h2>\r\n<p>Đôi khi bạn cần loại bỏ các phần tử trùng lặp khỏi một mảng. Bằng cách sử dụng đối tượng <code>Set</code>, bạn có thể dễ dàng tạo một mảng mới chỉ chứa các giá trị duy nhất.</p>\r\n<pre class=\"language-javascript\"><code>const numbers = [1, 2, 4, 5, 5, 1];\r\n\r\nconst uniqueNums = [...new Set(numbers)];\r\n// Kết quả: uniqueNums = [1, 2, 4, 5]</code></pre>\r\n<h2>4. Chuyển Đổi Số Sang Chuỗi</h2>\r\n<p>Để chuyển một số thành chuỗi, bạn có thể sử dụng phép cộng với một chuỗi rỗng.</p>\r\n<pre class=\"language-javascript\"><code>const myAge = 24;\r\nconsole.log(typeof myAge); // number\r\n\r\nconst myAgeString = \"\" + myAge;\r\nconsole.log(typeof myAgeString); // string</code></pre>\r\n<h2>5. Chuyển Đổi Chuỗi Sang Số</h2>\r\n<p>Khi bạn cần chuyển đổi một chuỗi thành số, bạn có thể sử dụng toán tử <code>+</code> hai lần để ép kiểu chuỗi thành số.</p>\r\n<pre class=\"language-javascript\"><code>const num1 = 10;\r\nconst num2 = \'80\';\r\nconsole.log(num1 + num2);\r\n// Kết quả: \"1080\"\r\n\r\nconsole.log(num1 + +num2);\r\n// Kết quả: 90</code></pre>\r\n<h2>6. Chuyển If-Else Sang 1 Dòng Code</h2>\r\n<p>Khi bạn cần thực hiện một cấu trúc điều kiện đơn giản, bạn có thể sử dụng biểu thức ba ngôi để viết mã ngắn gọn hơn.</p>\r\n<pre class=\"language-javascript\"><code>const isExpired = true;\r\n\r\n// IF-ELSE\r\nif (isExpired) {\r\n    console.log(\'This product has been expired\');\r\n} else {\r\n    console.log(\'This product is still in use\');\r\n}\r\n\r\n// REPLACE TO ONE LINE CODE\r\nisExpired ? console.log(\'This product has been expired\') : console.log(\'This product is still in use\');</code></pre>\r\n<p>Những trick Javascript trên giúp bạn viết mã ngắn gọn, hiệu quả hơn và dễ đọc hơn. Hãy thử áp dụng chúng trong dự án của bạn để nâng cao khả năng lập trình của mình. Chúng ta sẽ tiếp tục khám phá thêm nhiều trick thú vị khác trong các phần sau. Chúc bạn thành công trong việc học và ứng dụng Javascript!</p>', '[\"https:\\/\\/i.ytimg.com\\/vi\\/71W9f2yQQI0\\/mqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/71W9f2yQQI0\\/hqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/71W9f2yQQI0\\/maxresdefault.jpg\"]', NULL, 1, '2023-09-22 02:59:29', '2023-10-27 20:44:09'),
(3, 'Tạo Horizontal Media Scroller Bằng HTML và CSS', 'tao-horizontal-media-scroller-bang-html-va-css', '9UoWfvlGgBA', '<p>Trong bài viết này, chúng ta sẽ tìm hiểu cách tạo một Horizontal Media Scroller bằng HTML và CSS để hiển thị các hình ảnh một cách hiệu quả. </p>\r\n<h2>Bắt đầu với HTML</h2>\r\n<p>Đầu tiên, chúng ta cần cấu trúc HTML để đưa hình ảnh vào thanh cuộn. Dưới đây là mã HTML mẫu:</p>\r\n<pre class=\"language-markup\"><code>&lt;div class=\"scroller\"&gt;\r\n    &lt;div class=\"scroller-item\"&gt;\r\n        &lt;img src=\"1.jpg\" alt=\"Hình ảnh 1\" /&gt;\r\n    &lt;/div&gt;\r\n    &lt;div class=\"scroller-item\"&gt;\r\n        &lt;img src=\"2.jpg\" alt=\"Hình ảnh 2\" /&gt;\r\n    &lt;/div&gt;\r\n    &lt;div class=\"scroller-item\"&gt;\r\n        &lt;img src=\"3.jpg\" alt=\"Hình ảnh 3\" /&gt;\r\n    &lt;/div&gt;\r\n&lt;/div&gt;</code></pre>\r\n<h2>CSS cho Thanh Cuộn</h2>\r\n<p>Bây giờ, hãy tạo CSS để tạo thanh cuộn ngang và hiệu ứng hấp dẫn cho hình ảnh. Dưới đây là CSS mẫu:</p>\r\n<pre class=\"language-css\"><code>.scroller {\r\n    max-width: 390px;\r\n    padding: 10px;\r\n    display: grid;\r\n    grid-auto-flow: column;\r\n    column-gap: 1rem;\r\n    overflow-x: auto;\r\n}\r\n\r\n.scroller::-webkit-scrollbar {\r\n    display: none;\r\n}\r\n\r\n.scroller-item {\r\n    position: relative;\r\n    width: 100px;\r\n    height: 100px;\r\n    border: 4px solid #151515;\r\n    border-radius: 50%;\r\n}\r\n\r\n.scroller-item img {\r\n    width: 100%;\r\n    height: 100%;\r\n    object-fit: cover;\r\n    border-radius: 50%;\r\n}\r\n\r\n.scroller-item::before {\r\n    content: \"\";\r\n    position: absolute;\r\n    top: 50%;\r\n    left: 50%;\r\n    transform: translate(-50%, -50%);\r\n    width: calc(100% + 15px);\r\n    height: calc(100% + 15px);\r\n    background-image: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #6902be 75%, #bc1888 100%);\r\n    border-radius: inherit;\r\n    z-index: -1;\r\n}</code></pre>\r\n<h2>Cách Hoạt Động</h2>\r\n<ul style=\"list-style-type: disc;\">\r\n<li>\r\n<p>Chúng ta bọc hình ảnh vào một div với lớp \"scroller-item\" để tạo hiệu ứng hình tròn.</p>\r\n</li>\r\n<li>\r\n<p>Dùng CSS Grid để sắp xếp các mục \"scroller-item\" theo hàng ngang, tạo thanh cuộn ngang nếu chúng vượt quá chiều rộng của \"scroller\".</p>\r\n</li>\r\n<li>\r\n<p>Ẩn thanh cuộn mặc định bằng cách sử dụng <code>overflow-x: auto;</code> và <code>scroller::-webkit-scrollbar { display: none; }</code>.</p>\r\n</li>\r\n<li>\r\n<p>Sử dụng <code>::before</code> để tạo hiệu ứng nền hình tròn đẹp mắt với gradient màu.</p>\r\n</li>\r\n</ul>\r\n<p>Với mã HTML và CSS này, bạn có thể tạo một Horizontal Media Scroller tương tự trên Instagram để hiển thị các hình ảnh hoặc nội dung đa phương tiện một cách ấn tượng. Đừng ngần ngại tùy chỉnh nó để phù hợp với thiết kế của bạn.</p>', '[\"https:\\/\\/i.ytimg.com\\/vi\\/9UoWfvlGgBA\\/mqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/9UoWfvlGgBA\\/hqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/9UoWfvlGgBA\\/maxresdefault.jpg\"]', NULL, 1, '2023-09-24 14:17:46', '2023-10-28 09:25:14'),
(4, 'Đọc số nguyên lớn trong Python dễ dàng hơn', 'doc-so-nguyen-lon-trong-python-de-dang-hon', 'iVKJ3yy-5ng', '<p>Trong bài viết này, chúng ta sẽ tìm hiểu về một số mẹo hay với số nguyên trong Python, giúp cho việc viết và đọc code dễ dàng hơn.</p>\r\n<p>Hãy bắt đầu với một ví dụ đơn giản:</p>\r\n<pre class=\"language-python\"><code>num1 = 5000000000\r\nnum2 = 6000000000\r\ntotal = num1 * num2\r\n\r\nprint(total)</code></pre>\r\n<p>Thường thì khi bạn viết một số nguyên lớn trong Python, bạn sẽ viết liền các chữ số lại với nhau, ví dụ như <strong>5000000000</strong> hay <strong>6000000000</strong>. Tuy nhiên, điều này làm cho việc đọc và hiểu giá trị của số nguyên trở nên khó khăn. Bạn có thể giải quyết vấn đề này bằng cách thêm dấu gạch dưới (_) vào giữa các chữ số, để tạo thành các nhóm có ba chữ số. Ví dụ:</p>\r\n<pre class=\"language-python\"><code>num1 = 5_000_000_000\r\nnum2 = 6_000_000_000\r\ntotal = num1 * num2\r\n\r\nprint(total)</code></pre>\r\n<p>Việc thêm dấu gạch dưới không làm thay đổi giá trị của số nguyên, chỉ là một cách để format code cho dễ đọc. Bạn có thể thấy rõ hơn rằng num1 là 5 tỷ và num2 là 6 tỷ.</p>\r\n<p>Ngoài ra, bạn cũng có thể sử dụng f-string để in ra kết quả có dấu gạch dưới. F-string là một cách để format chuỗi trong Python, cho phép bạn chèn các biến hoặc biểu thức vào trong chuỗi. Để in ra kết quả có dấu gạch dưới, bạn chỉ cần thêm ký hiệu (_) vào sau dấu hai chấm (:) trong f-string. Ví dụ:</p>\r\n<pre class=\"language-python\"><code>num1 = 5_000_000_000\r\nnum2 = 6_000_000_000\r\ntotal = num1 * num2\r\n\r\nprint(f\"{total:_}\")</code></pre>\r\n<p>Đoạn code trên sẽ in ra kết quả là <strong>30_000_000_000_000_000</strong>, một con số rất lớn nhưng vẫn dễ nhìn.</p>\r\n<p>Bạn cũng có thể thay thế dấu gạch dưới bằng dấu phẩy (,) nếu bạn muốn tuân theo quy tắc viết số của tiếng Anh. Ví dụ:</p>\r\n<pre class=\"language-python\"><code>num1 = 5_000_000_000\r\nnum2 = 6_000_000_000\r\ntotal = num1 * num2\r\n\r\nprint(f\"{total:,}\")</code></pre>\r\n<p>Đoạn code trên sẽ in ra kết quả là <strong>30,000,000,000,000,000</strong>.</p>\r\n<p>Như vậy, bạn đã biết cách sử dụng dấu gạch dưới và f-string để làm cho số nguyên trong Python đẹp mắt và dễ đọc hơn. Hy vọng bài viết này có ích cho bạn. Hãy theo dõi blog của tôi để cập nhật thêm nhiều mẹo hay khác nhé!</p>', '[\"https:\\/\\/i.ytimg.com\\/vi\\/iVKJ3yy-5ng\\/mqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/iVKJ3yy-5ng\\/hqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/iVKJ3yy-5ng\\/maxresdefault.jpg\"]', NULL, 1, '2023-09-30 15:30:06', '2023-10-29 15:03:31'),
(5, 'Cách Kiểm tra và Phản ứng với Sự thay đổi Trạng thái Kết nối Mạng trong JavaScript', 'cach-kiem-tra-va-phan-ung-voi-su-thay-doi-trang-thai-ket-noi-mang-trong-javascript', 'cgOUfXO4k6s', '<p>Trong thời đại công nghệ số, kết nối mạng là một yếu tố quan trọng đối với nhiều ứng dụng web. Tuy nhiên, không phải lúc nào người dùng cũng có thể duy trì kết nối mạng ổn định. Đôi khi, người dùng có thể bị mất kết nối mạng do lỗi kỹ thuật, hết pin, hoặc di chuyển ra khỏi vùng phủ sóng. Khi đó, ứng dụng web của bạn cần phải xử lý tình huống này một cách thông minh và thân thiện với người dùng.</p>\r\n<p>JavaScript cung cấp cho bạn hai sự kiện để theo dõi trạng thái kết nối mạng của người dùng: \"offline\" và \"online\". Bạn có thể sử dụng các sự kiện này để thực hiện các hành động phù hợp khi người dùng mất hoặc trở lại có kết nối mạng. Ví dụ, bạn có thể hiển thị thông báo cho người dùng biết rằng họ đang offline, lưu trữ dữ liệu vào bộ nhớ đệm để đồng bộ hóa sau khi online, hoặc tải lại trang web để cập nhật dữ liệu mới nhất.</p>\r\n<p>Để sử dụng các sự kiện này, bạn chỉ cần thêm các trình xử lý sự kiện vào đối tượng window. Cú pháp như sau:</p>\r\n<pre class=\"language-javascript\"><code>window.addEventListener(\"offline\", () =&gt; {\r\n    // Xử lý khi người dùng mất kết nối mạng\r\n});\r\n\r\nwindow.addEventListener(\"online\", () =&gt; {\r\n    // Xử lý khi người dùng trở lại có kết nối mạng\r\n});</code></pre>\r\n<p>Bạn cũng có thể kiểm tra trạng thái kết nối mạng hiện tại của người dùng bằng cách sử dụng thuộc tính navigator.onLine. Thuộc tính này trả về true nếu người dùng đang online và false nếu người dùng đang offline. Ví dụ:</p>\r\n<pre class=\"language-javascript\"><code>if (navigator.onLine) {\r\n    console.log(\"Bạn đang online\");\r\n} else {\r\n    console.log(\"Bạn đang offline\");\r\n}</code></pre>\r\n<p>Tuy nhiên, bạn cần lưu ý rằng thuộc tính navigator.onLine chỉ kiểm tra xem người dùng có kết nối với một mạng nào đó hay không, chứ không kiểm tra xem người dùng có thể truy cập được Internet hay không. Nếu người dùng kết nối với một mạng không có Internet, thuộc tính này vẫn trả về true. Do đó, bạn nên sử dụng các phương pháp khác để kiểm tra khả năng truy cập Internet của người dùng, ví dụ như gửi yêu cầu AJAX hoặc ping một máy chủ.</p>\r\n<p>Hy vọng bài viết này sẽ giúp bạn hiểu rõ hơn về cách kiểm tra và phản ứng với sự thay đổi trạng thái kết nối mạng trong JavaScript. Nếu bạn có bất kỳ câu hỏi hay góp ý gì, xin vui lòng để lại bình luận bên dưới. Cảm ơn bạn đã đọc bài viết.</p>', '[\"https:\\/\\/i.ytimg.com\\/vi\\/cgOUfXO4k6s\\/mqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/cgOUfXO4k6s\\/hqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/cgOUfXO4k6s\\/maxresdefault.jpg\"]', NULL, 1, '2023-09-30 15:31:06', '2023-10-12 14:55:49'),
(6, 'Tại sao nên dùng Object thay vì Switch Case trong Javascript', 'tai-sao-nen-dung-object-thay-vi-switch-case-trong-javascript', 'qkFTM7CfhU0', '<p>Trong Javascript, có nhiều cách để xử lý các trường hợp khác nhau dựa trên một biến hoặc một giá trị. Một cách phổ biến là sử dụng câu lệnh switch case, ví dụ như sau:</p>\r\n<pre class=\"language-javascript\"><code>const getErrMsg = function (errCode) {\r\n    switch (errCode) {\r\n        case 30001:\r\n            return \"Transaction is expired\";\r\n        case 30002:\r\n            return \"Payment method is invalid\";\r\n        case 30003:\r\n            return \"Channel is empty\";\r\n    }\r\n};</code></pre>\r\n<p>Hàm này nhận vào một mã lỗi và trả về một thông báo lỗi tương ứng. Tuy nhiên, cách này có một số nhược điểm:</p>\r\n<ul>\r\n<li>Câu lệnh switch case khá dài và khó đọc, đặc biệt khi có nhiều trường hợp.</li>\r\n<li>Câu lệnh switch case không thể tái sử dụng được, nếu muốn sử dụng lại các thông báo lỗi ở nơi khác, phải viết lại toàn bộ câu lệnh.</li>\r\n<li>Câu lệnh switch case không linh hoạt, nếu muốn thêm hoặc bớt các trường hợp, phải sửa đổi trực tiếp trong câu lệnh.</li>\r\n</ul>\r\n<p>Một cách khác để xử lý các trường hợp khác nhau là sử dụng object, ví dụ như sau:</p>\r\n<pre class=\"language-javascript\"><code>const getErrMsg2 = function (errCode) {\r\n    const errMsg = {\r\n        30001: \"Transaction is expired\",\r\n        30002: \"Payment method is invalid\",\r\n        30003: \"Channel is empty\",\r\n    };\r\n    return errMsg[errCode];\r\n};</code></pre>\r\n<p>Hàm này cũng nhận vào một mã lỗi và trả về một thông báo lỗi tương ứng. Tuy nhiên, cách này có một số ưu điểm:</p>\r\n<ul>\r\n<li>Object ngắn gọn và dễ đọc hơn switch case, chỉ cần khai báo một object chứa các cặp mã lỗi và thông báo lỗi.</li>\r\n<li>Object có thể tái sử dụng được, nếu muốn sử dụng lại các thông báo lỗi ở nơi khác, chỉ cần truyền vào object đó.</li>\r\n<li>Object linh hoạt hơn switch case, nếu muốn thêm hoặc bớt các trường hợp, chỉ cần thêm hoặc bớt các thuộc tính trong object.</li>\r\n</ul>\r\n<p>Vì vậy, khi viết code Javascript, bạn nên cân nhắc sử dụng object thay vì switch case để xử lý các trường hợp khác nhau. Đây là một Trick loR hiệu quả và tiết kiệm thời gian.</p>', '[\"https:\\/\\/i.ytimg.com\\/vi\\/qkFTM7CfhU0\\/mqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/qkFTM7CfhU0\\/hqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/qkFTM7CfhU0\\/maxresdefault.jpg\"]', NULL, 1, '2023-09-30 21:32:27', '2023-10-12 14:48:15'),
(7, 'Sử dụng :is() và :where() để viết CSS ngắn gọn và hiệu quả', 'su-dung-is-va-where-de-viet-css-ngan-gon-va-hieu-qua', 'kxW1DPIowV4', '<p>Bạn có bao giờ phải viết CSS với nhiều bộ chọn lặp lại cùng một thuộc tính không? Ví dụ như:</p>\r\n<pre class=\"language-css\"><code>ul li a,\r\nol li a {\r\n    color: red;\r\n}</code></pre>\r\n<pre class=\"language-css\"><code>main h1,\r\nmain h2,\r\nmain h3 {\r\n    color: orange;\r\n}</code></pre>\r\n<p>Đây là một cách viết CSS khá phổ biến, nhưng cũng khá dài dòng và khó bảo trì. Nếu bạn muốn thay đổi màu sắc cho tất cả các liên kết trong danh sách, bạn phải sửa đổi cả hai bộ chọn ul li a và ol li a. Nếu bạn muốn thêm một thẻ tiêu đề khác vào main, bạn phải thêm vào bộ chọn main h1, main h2, main h3.</p>\r\n<p>Có một cách viết CSS ngắn gọn và hiệu quả hơn, đó là sử dụng hai thuộc tính mới là :is() và :where(). Hai thuộc tính này cho phép bạn nhóm nhiều bộ chọn lại thành một bộ chọn duy nhất, và áp dụng cùng một thuộc tính cho tất cả các bộ chọn đó. Cách viết này không chỉ tiết kiệm thời gian và công sức, mà còn giúp mã nguồn CSS dễ đọc và dễ hiểu hơn.</p>\r\n<p>Ví dụ, bạn có thể viết lại hai đoạn CSS trên như sau:</p>\r\n<pre class=\"language-css\"><code>:is(ul, ol) a {\r\n    color: red;\r\n}</code></pre>\r\n<pre class=\"language-css\"><code>main :where(h1, h2, h3) {\r\n    color: orange;\r\n}</code></pre>\r\n<p>Như bạn thấy, cách viết này ngắn gọn và rõ ràng hơn nhiều. Bạn chỉ cần sử dụng :is() hoặc :where() để nhóm các bộ chọn lại, và sau đó áp dụng thuộc tính cho bộ chọn đó. Bạn không cần phải lặp lại các bộ chọn nhiều lần nữa.</p>\r\n<p>Vậy :is() và :where() có gì khác nhau? Có hai điểm khác biệt chính giữa hai thuộc tính này:</p>\r\n<ul>\r\n<li>:is() có tính đặc trưng (specificity) cao hơn :where(). Điều này có nghĩa là nếu có hai bộ chọn áp dụng cùng một thuộc tính cho cùng một phần tử, bộ chọn có :is() sẽ được ưu tiên hơn. Ví dụ:</li>\r\n</ul>\r\n<pre class=\"language-css\"><code>div p {\r\n    color: blue;\r\n}\r\n\r\ndiv :is(p) {\r\n    color: green;\r\n}\r\n\r\ndiv :where(p) {\r\n    color: red;\r\n}</code></pre>\r\n<p>Trong ví dụ này, tất cả các thẻ p trong thẻ div sẽ có màu xanh lá cây, vì bộ chọn div :is(p) có đặc trưng cao hơn div p và div :where(p).</p>\r\n<ul>\r\n<li>:is() không được hỗ trợ bởi tất cả các trình duyệt. Hiện tại, chỉ có Chrome, Firefox, Safari và Edge mới hỗ trợ :is(), còn các trình duyệt khác như Opera, IE hay các trình duyệt cũ hơn thì không. Do đó, nếu bạn muốn tương thích với nhiều trình duyệt nhất có thể, bạn nên sử dụng :where() thay vì :is(). Tuy nhiên, bạn cũng nên lưu ý rằng :where() cũng không được hỗ trợ bởi IE và các trình duyệt cũ hơn.</li>\r\n</ul>\r\n<p>Như vậy, bạn đã biết cách sử dụng :is() và :where() để viết CSS ngắn gọn và hiệu quả hơn. Hai thuộc tính này là một tính năng mới và hữu ích của CSS, giúp bạn tiết kiệm thời gian và công sức khi viết mã nguồn. Bạn có thể thử áp dụng chúng vào các dự án của mình, và xem kết quả như thế nào. Chúc bạn thành công!</p>', '[\"https:\\/\\/i.ytimg.com\\/vi\\/kxW1DPIowV4\\/mqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/kxW1DPIowV4\\/hqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/kxW1DPIowV4\\/maxresdefault.jpg\"]', NULL, 1, '2023-09-30 21:33:44', '2023-10-12 12:34:56'),
(9, 'Sử dụng regex trong CSS để lựa chọn các phần tử HTML một cách linh hoạt', 'su-dung-regex-trong-css-de-lua-chon-cac-phan-tu-html-mot-cach-linh-hoat', '117L6ifKIPI', '<pre class=\"language-markup\"><code>&lt;div id=\"im-item1\"&gt;item1&lt;/div&gt;\r\n&lt;div id=\"item2-bold\"&gt;item2&lt;/div&gt;\r\n&lt;div id=\"item3\"&gt;item3&lt;/div&gt;</code></pre>\r\n<p>Bạn có biết rằng trong CSS, chúng ta có thể sử dụng regex (biểu thức chính quy) để lựa chọn các phần tử HTML một cách linh hoạt và tiện lợi? Regex là một công cụ mạnh mẽ để xử lý các chuỗi ký tự, cho phép chúng ta tìm kiếm, thay thế, hoặc trích xuất các phần của chuỗi theo một quy tắc nào đó. Trong CSS, chúng ta có thể sử dụng regex để lựa chọn các phần tử HTML theo thuộc tính id, class, name, hoặc bất kỳ thuộc tính nào khác.</p>\r\n<p>Để sử dụng regex trong CSS, chúng ta sử dụng các toán tử sau:</p>\r\n<ul>\r\n<li><code>^=</code>: Chọn các phần tử có thuộc tính bắt đầu bằng một giá trị nào đó. Ví dụ: <code>div[id^=\"im\"]</code> sẽ chọn tất cả các thẻ div có id bắt đầu bằng “im”.</li>\r\n<li><code>$=</code>: Chọn các phần tử có thuộc tính kết thúc bằng một giá trị nào đó. Ví dụ: <code>div[id$=\"-bold\"]</code> sẽ chọn tất cả các thẻ div có id kết thúc bằng “-bold”.</li>\r\n<li><code>*=</code>: Chọn các phần tử có thuộc tính chứa một giá trị nào đó. Ví dụ: <code>div[id*=\"item\"]</code> sẽ chọn tất cả các thẻ div có id chứa “item”.</li>\r\n<li><code>|=</code>: Chọn các phần tử có thuộc tính bằng hoặc bắt đầu bằng một giá trị nào đó và theo sau là một dấu gạch ngang (-). Ví dụ: <code>div[id|=\"im\"]</code> sẽ chọn tất cả các thẻ div có id bằng “im” hoặc bắt đầu bằng “im-”.</li>\r\n<li><code>~=</code>: Chọn các phần tử có thuộc tính chứa một từ nào đó trong danh sách được ngăn cách bởi khoảng trắng. Ví dụ: <code>div[class~=\"red\"]</code> sẽ chọn tất cả các thẻ div có class chứa từ “red”.</li>\r\n</ul>\r\n<p>Chúng ta cũng có thể kết hợp nhiều toán tử regex để lựa chọn các phần tử theo điều kiện phức tạp hơn. Ví dụ: <code>div[id^=\"im\"][id*=\"item\"]</code> sẽ chọn tất cả các thẻ div có id bắt đầu bằng “im” và chứa “item”.</p>\r\n<p>Với regex trong CSS, chúng ta có thể áp dụng các quy tắc kiểu (style rules) cho các phần tử HTML một cách linh hoạt và tiện lợi hơn. Bạn hãy thử sử dụng regex trong CSS để tạo ra những trang web đẹp và ấn tượng nhé!</p>', '[\"https:\\/\\/i.ytimg.com\\/vi\\/117L6ifKIPI\\/mqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/117L6ifKIPI\\/hqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/117L6ifKIPI\\/maxresdefault.jpg\"]', NULL, 1, '2023-09-30 21:38:12', '2023-10-15 09:37:30'),
(10, 'Hai Cách Đơn Giản để Lấy Phần Tử Cuối Cùng trong Mảng JavaScript', 'hai-cach-don-gian-de-lay-phan-tu-cuoi-cung-trong-mang-javascript', 'D2xPD4lrf0o', '<p>Trong bài viết này, chúng tôi sẽ giới thiệu cho bạn hai cách đơn giản để lấy phần tử cuối cùng trong mảng Javascript.</p>\r\n<h3>Cách 1: Dùng thuộc tính `length` của mảng</h3>\r\n<p>Cách đầu tiên và cổ điển nhất để lấy phần tử cuối cùng trong mảng là dùng thuộc tính <code>length</code> của mảng. Thuộc tính này cho biết số lượng phần tử trong mảng. Bạn có thể lấy phần tử cuối cùng bằng cách trừ đi 1 từ <code>length</code> và dùng kết quả đó làm chỉ số của mảng. Ví dụ:</p>\r\n<pre class=\"language-javascript\"><code>const list = [1, 2, 3, 4];\r\nconst last = list[list.length - 1];\r\n// Kết quả: last = 4</code></pre>\r\n<p>Như bạn thấy, chúng ta đã dùng <code>list.length - 1</code> để lấy ra chỉ số của phần tử cuối cùng trong mảng <code>list</code>. Cách này hoạt động với tất cả các phiên bản JavaScript.</p>\r\n<h3>Cách 2: Dùng phương thức `at()` của mảng</h3>\r\n<p>Cách thứ hai và mới hơn để lấy phần tử cuối cùng trong mảng là dùng phương thức <code>at()</code> của mảng. Phương thức này cho phép bạn truy cập vào phần tử của mảng bằng cách dùng số nguyên làm tham số. Nếu số nguyên là dương, bạn sẽ lấy được phần tử từ đầu mảng. Nếu số nguyên là âm, bạn sẽ lấy được phần tử từ cuối mảng. Ví dụ:</p>\r\n<pre class=\"language-javascript\"><code>const list = [1, 2, 3, 4];\r\nconst last = list.at(-1);\r\n// Kết quả: last = 4</code></pre>\r\n<p>Với <code>at()</code>, bạn chỉ cần dùng số âm <code>-1</code> là đã có thể lấy được phần tử cuối cùng trong mảng rồi. Cách này rất tiện lợi và ngắn gọn. Tuy nhiên, bạn cần chú ý rằng <code>at()</code> chỉ hoạt động với phiên bản JavaScript ES6 trở lên.</p>\r\n<h3>Chọn cách nào?</h3>\r\n<p>Bạn có thể chọn cách nào tùy theo sở thích và yêu cầu của bạn. Nếu bạn muốn viết code tương thích với nhiều phiên bản JavaScript khác nhau, bạn nên dùng cách 1 với thuộc tính <code>length</code>. Nếu bạn muốn viết code ngắn gọn và hiện đại, bạn nên dùng cách 2 với phương thức <code>at()</code>.</p>\r\n<h3>Tóm tắt</h3>\r\n<p>Lấy phần tử cuối cùng trong mảng JavaScript không khó như bạn nghĩ. Bạn chỉ cần nhớ hai cách đơn giản là dùng thuộc tính <code>length</code> hoặc phương thức <code>at()</code>. Hãy áp dụng những kiến thức này vào dự án của bạn và xem kết quả nhé.</p>', '[\"https:\\/\\/i.ytimg.com\\/vi\\/D2xPD4lrf0o\\/mqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/D2xPD4lrf0o\\/hqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/D2xPD4lrf0o\\/maxresdefault.jpg\"]', NULL, 1, '2023-09-30 21:41:22', '2023-10-15 16:31:32'),
(11, 'Tận dụng Scroll-snap-type trong CSS để Tạo Hiệu Ứng Cuộn Trang Thú vị', 'tan-dung-scroll-snap-type-trong-css-de-tao-hieu-ung-cuon-trang-thu-vi', 'CYl9CrEqDIs', '<p>Trong bài viết này, chúng ta sẽ tìm hiểu cách sử dụng <code>scroll-snap-type</code> để tạo hiệu ứng cuộn trang thú vị cho trang web của bạn.</p>\r\n<h2>Scroll-snap-type là gì?</h2>\r\n<p>Trước khi bắt đầu, hãy hiểu rõ <code>scroll-snap-type</code> là gì. Nó là một thuộc tính CSS cho phép bạn kiểm soát cách cuộn nội dung trên trang web của bạn. Điều này đặc biệt hữu ích khi bạn muốn cuộn một phần tử vào tầm nhìn người dùng một cách dễ dàng hơn. Chẳng hạn, bạn có một danh sách sản phẩm và muốn người dùng nhìn thấy từng sản phẩm một khi cuộn trang.</p>\r\n<h2>Bắt đầu với Scroll-snap-type</h2>\r\n<p>Để bắt đầu, bạn cần một phần tử chứa nội dung bạn muốn cuộn. Dưới đây là ví dụ HTML và CSS sơ bộ:</p>\r\n<pre class=\"language-markup\"><code>&lt;div class=\"container\"&gt;\r\n    &lt;div class=\"item\"&gt;\r\n        &lt;!-- Nội dung 1 --&gt;\r\n    &lt;/div&gt;\r\n    &lt;div class=\"item\"&gt;\r\n        &lt;!-- Nội dung 2 --&gt;\r\n    &lt;/div&gt;\r\n&lt;/div&gt;</code></pre>\r\n<pre class=\"language-css\"><code>* {\r\n    box-sizing: border-box;\r\n}\r\n\r\n.container {\r\n    display: flex;\r\n    overflow-x: scroll;\r\n    padding: 24px;\r\n    width: 300px;\r\n    scroll-snap-type: x mandatory;\r\n    scroll-padding: 24px;\r\n    border-radius: 8px;\r\n    gap: 12px;\r\n}\r\n\r\n.container .item {\r\n    flex: 0 0 100%;\r\n    padding: 24px;\r\n    border-radius: 8px;\r\n    scroll-snap-align: start;\r\n}</code></pre>\r\n<p>Trong ví dụ trên, <code>.container</code> là phần tử chứa nội dung bạn muốn cuộn. <code>.item</code> là các phần tử con của <code>.container</code>. Để áp dụng <code>scroll-snap-type</code>, bạn đặt <code>scroll-snap-type: x mandatory;</code> cho <code>.container</code>. Thuộc tính này cho biết rằng bạn muốn cuộn theo trục x và muốn nó cuốn từng phần tử một.</p>\r\n<h3>Hiệu ứng cuốn trang thú vị</h3>\r\n<p>Khi bạn đã thiết lập <code>scroll-snap-type</code>, bạn sẽ thấy sự khác biệt ngay lập tức. Khi bạn cuộn trang, nội dung sẽ tự động cuốn để căn chỉnh với các phần tử con của <code>.container</code>. Điều này tạo ra một hiệu ứng cuốn trang thú vị và tạo cảm giác trực quan tốt hơn cho người dùng.</p>\r\n<h3>Tùy chỉnh và Tối ưu hóa</h3>\r\n<p>Tất nhiên, bạn có thể tùy chỉnh các giá trị và kiểu cuốn theo ý muốn. Bạn có thể thay đổi khoảng cách giữa các phần tử, độ rộng của <code>.container</code>, hoặc áp dụng các hiệu ứng CSS khác để làm cho trang web của bạn trở nên độc đáo và thú vị.</p>\r\n<p>Tận dụng <code>scroll-snap-type</code> để làm cho trang web của bạn trở nên thú vị hơn và tạo trải nghiệm cuốn trang tốt hơn cho người dùng. Đừng ngần ngại thử nghiệm và tùy chỉnh để tạo ra hiệu ứng cuốn trang ấn tượng và đáng nhớ.</p>', '[\"https:\\/\\/i.ytimg.com\\/vi\\/CYl9CrEqDIs\\/mqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/CYl9CrEqDIs\\/hqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/CYl9CrEqDIs\\/maxresdefault.jpg\"]', NULL, 1, '2023-09-30 21:46:44', '2023-10-18 20:10:48'),
(12, 'Các Hàm Xử Lý Chuỗi Trong JavaScript', 'cac-ham-xu-ly-chuoi-trong-javascript', 'aYroxuKFytU', '<p>JavaScript có nhiều tính năng hữu ích cho việc làm việc với chuỗi. Trong bài viết này, chúng ta sẽ tìm hiểu về một số hàm xử lý chuỗi quan trọng trong JavaScript.</p>\r\n<h2>1. toLowerCase() và toUpperCase()</h2>\r\n<p>Hàm <code>toLowerCase()</code> và <code>toUpperCase()</code> cho phép bạn chuyển đổi chuỗi thành dạng chữ thường hoặc chữ hoa.</p>\r\n<pre class=\"language-javascript\"><code>const text = \"Avance Dev\";\r\ntext.toLowerCase(); // avance dev\r\ntext.toUpperCase(); // AVANCE DEV</code></pre>\r\n<h2>2. length</h2>\r\n<p>Hàm <code>length</code> trả về độ dài của chuỗi.</p>\r\n<pre class=\"language-javascript\"><code>const text = \"Avance Dev\";\r\ntext.length; // 10</code></pre>\r\n<h2>3. charAt(index)</h2>\r\n<p>Hàm <code>charAt(index)</code> trả về ký tự ở vị trí được chỉ định trong chuỗi.</p>\r\n<pre class=\"language-javascript\"><code>const text = \"Avance Dev\";\r\ntext.charAt(2); // a</code></pre>\r\n<h2>4. includes(substring)</h2>\r\n<p>Hàm <code>includes(substring)</code> kiểm tra xem chuỗi có chứa một chuỗi con cụ thể hay không và trả về <code>true</code> hoặc <code>false</code>.</p>\r\n<pre class=\"language-javascript\"><code>const text = \"Avance Dev\";\r\ntext.includes(\"ce\"); // true</code></pre>\r\n<h2>5. concat(string)</h2>\r\n<p>Hàm <code>concat(string)</code> nối chuỗi với một chuỗi khác.</p>\r\n<pre class=\"language-javascript\"><code>const text = \"Avance Dev\";\r\ntext.concat(\"eloper\"); // avance developer</code></pre>\r\n<h2>6. slice(start, end)</h2>\r\n<p>Hàm <code>slice(start, end)</code> trích xuất một phần của chuỗi từ vị trí bắt đầu đến vị trí kết thúc (không bao gồm).</p>\r\n<pre class=\"language-javascript\"><code>const text = \"Avance Dev\";\r\ntext.slice(0, 2); // Av</code></pre>\r\n<h2>7. split(separator)</h2>\r\n<p>Hàm <code>split(separator)</code> chia chuỗi thành một mảng các chuỗi con dựa trên dấu phân tách được chỉ định.</p>\r\n<pre class=\"language-javascript\"><code>const text = \"Avance Dev\";\r\ntext.split(\" \"); // [\"Avance\", \"Dev\"]</code></pre>\r\n<h2>8. replace(old, new)</h2>\r\n<p>Hàm <code>replace(old, new)</code> thay thế chuỗi con cụ thể trong chuỗi với một chuỗi mới.</p>\r\n<pre class=\"language-javascript\"><code>const text = \"Avance Dev\";\r\ntext.replace(\"Avance\", \"Go\"); // Go dev</code></pre>\r\n<h2>9. Truy cập ký tự theo chỉ số</h2>\r\n<p>Bạn có thể truy cập một ký tự trong chuỗi bằng cách sử dụng chỉ số.</p>\r\n<pre class=\"language-javascript\"><code>const text = \"Avance Dev\";\r\ntext[4]; // c</code></pre>\r\n<h2>10. trim()</h2>\r\n<p>Hàm <code>trim()</code> loại bỏ khoảng trắng không cần thiết từ đầu và cuối chuỗi.</p>\r\n<pre class=\"language-javascript\"><code>const text = \"    Avance Dev    \";\r\ntext.trim(); // Avance Dev</code></pre>\r\n<p>Chúng ta đã tìm hiểu về một số hàm quan trọng để xử lý chuỗi trong JavaScript. Những hàm này rất hữu ích trong việc làm việc với dữ liệu chuỗi và giúp bạn thực hiện các thao tác xử lý chuỗi một cách dễ dàng hơn. Hy vọng rằng bạn sẽ tận dụng được kiến thức này trong công việc lập trình của mình.</p>', '[\"https:\\/\\/i.ytimg.com\\/vi\\/aYroxuKFytU\\/mqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/aYroxuKFytU\\/hqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/aYroxuKFytU\\/maxresdefault.jpg\"]', NULL, 1, '2023-09-30 21:49:54', '2023-10-19 10:35:49'),
(13, 'Tối Ưu Hóa Hiển Thị Danh Sách Hình Ảnh Có Tỷ Lệ Khác Nhau với CSS', 'toi-uu-hoa-hien-thi-danh-sach-hinh-anh-co-ty-le-khac-nhau-voi-css', 'JJFdtsIo5ns', '<p>CSS (Cascading Style Sheets) đã trở thành một phần quan trọng trong việc thiết kế và hiển thị trang web. Trong bài viết này, chúng ta sẽ khám phá một số mẹo CSS thú vị để tối ưu hóa hiển thị danh sách hình ảnh có tỷ lệ khác nhau. Điều này đặc biệt hữu ích khi bạn cần hiển thị nhiều hình ảnh với kích thước và tỷ lệ khác nhau mà bạn muốn chúng có cùng chiều rộng hoặc chiều cao.</p>\r\n<h2>1. Sử dụng CSS Aspect Ratio</h2>\r\n<p>Bắt đầu bằng việc sử dụng CSS Aspect Ratio để làm cho tất cả các hình ảnh có cùng tỷ lệ chiều rộng và chiều cao. Trong ví dụ, chúng ta sử dụng aspect-ratio với giá trị 3/2 để đảm bảo rằng tất cả các hình ảnh có tỷ lệ 3:2. Điều này giúp làm cho chúng trông đều đẹp hơn và dễ quản lý hơn.</p>\r\n<pre class=\"language-css\"><code>.photo img {\r\n    width: 15%;\r\n    aspect-ratio: 3/2;\r\n}</code></pre>\r\n<h2>2. Sử dụng Object Fit</h2>\r\n<p>Một khi bạn đã cân nhắc tỷ lệ, có thể xảy ra tình trạng căng hình ảnh khi chúng bị kéo giãn để vừa vào khu vực cố định. Điều này có thể tạo ra một hiệu ứng không mong muốn. Để khắc phục tình trạng này, bạn có thể sử dụng thuộc tính <code>object-fit: contain;</code>. Thuộc tính này giúp giữ nguyên tỷ lệ của hình ảnh trong khu vực cố định mà bạn đã xác định.</p>\r\n<pre class=\"language-css\"><code>.photo img {\r\n    object-fit: contain;\r\n}</code></pre>\r\n<h2>3. Mix Blend Mode</h2>\r\n<p>Cuối cùng, nếu bạn gặp vấn đề với nền đen hoặc nền trắng trong các hình ảnh, bạn có thể sử dụng <code>mix-blend-mode</code> để điều chỉnh màu sắc của hình ảnh. Đặc biệt, nếu bạn muốn loại bỏ nền trắng trong các hình ảnh, bạn có thể sử dụng <code>mix-blend-mode: color-burn;</code> để làm cho nền trắng trở nên trong suốt.</p>\r\n<pre class=\"language-css\"><code>.photo img {\r\n    mix-blend-mode: color-burn;\r\n}</code></pre>\r\n<h2>Kết Luận</h2>\r\n<p>Như vậy, với những mẹo CSS này, bạn có thể tối ưu hóa hiển thị danh sách hình ảnh có tỷ lệ khác nhau một cách dễ dàng và thú vị hơn. Sử dụng CSS Aspect Ratio, Object Fit, và Mix Blend Mode có thể giúp trang web của bạn trông chuyên nghiệp và thú vị hơn. Hãy thử áp dụng chúng vào dự án của bạn và tạo ra một trải nghiệm tuyệt vời cho người dùng.</p>', '[\"https:\\/\\/i.ytimg.com\\/vi\\/JJFdtsIo5ns\\/mqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/JJFdtsIo5ns\\/hqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/JJFdtsIo5ns\\/maxresdefault.jpg\"]', NULL, 1, '2023-09-30 22:08:45', '2023-10-27 08:38:02'),
(14, 'Tối ưu hóa Trải nghiệm Người Dùng với Tự động Vô hiệu hóa Nút Gửi trong Form', 'toi-uu-hoa-trai-nghiem-nguoi-dung-voi-tu-dong-vo-hieu-hoa-nut-gui-trong-form', 'jNj0s00U7k4', '<p>Trong bài viết này, chúng ta sẽ tìm hiểu cách tạo một biểu mẫu HTML đơn giản và làm cho nút Gửi tự động vô hiệu hóa khi người dùng chưa điền đầy đủ thông tin cần thiết.</p>\r\n<p>Dưới đây là một ví dụ về biểu mẫu HTML cơ bản:</p>\r\n<pre class=\"language-markup\"><code>&lt;form&gt;\r\n    &lt;input type=\"text\" class=\"input\" placeholder=\"Nhập tin nhắn\" required /&gt;\r\n    &lt;button type=\"submit\" class=\"button\"&gt;Gửi&lt;/button&gt;\r\n&lt;/form&gt;</code></pre>\r\n<p>Trong ví dụ trên, chúng ta có một ô nhập liệu và một nút Gửi. Thuộc tính <code>required</code> trên ô nhập liệu đảm bảo rằng người dùng phải điền thông tin trước khi gửi biểu mẫu. Tuy nhiên, để cải thiện trải nghiệm người dùng, chúng ta có thể tự động vô hiệu hóa nút Gửi cho đến khi biểu mẫu đạt yêu cầu.</p>\r\n<p>Để làm điều này, chúng ta sử dụng CSS. Chúng ta sẽ áp dụng một quy tắc CSS để vô hiệu hóa nút Gửi khi ô nhập liệu chưa hợp lệ (chưa được điền thông tin):</p>\r\n<pre class=\"language-css\"><code>.input:invalid + .button {\r\n    pointer-events: none;\r\n    opacity: 0.5;\r\n}</code></pre>\r\n<p>Trong đoạn mã CSS trên, chúng ta sử dụng một kết hợp tiền điều kiện (<code>:invalid</code>) để chọn ô nhập liệu chưa hợp lệ và sau đó chọn nút Gửi ngay sau nó (<code>+ .button</code>). Chúng ta đặt <code>pointer-events: none</code> để vô hiệu hóa nút Gửi và <code>opacity: 0.5</code> để làm mờ nó.</p>\r\n<p>Kết quả của việc này là nút Gửi sẽ không thể nhấn được (vô hiệu hóa) cho đến khi người dùng điền đầy đủ thông tin vào ô nhập liệu. Điều này giúp tránh gửi biểu mẫu không hoàn chỉnh và cải thiện trải nghiệm người dùng.</p>\r\n<p>Trong bài viết này, chúng ta đã tìm hiểu cách sử dụng CSS để tự động vô hiệu hóa nút Gửi trong biểu mẫu HTML cho đến khi biểu mẫu đạt yêu cầu. Điều này giúp cải thiện trải nghiệm người dùng và đảm bảo rằng thông tin được gửi đi là đầy đủ và hợp lệ. Hy vọng rằng bạn đã tìm thấy thông tin này hữu ích trong việc phát triển trang web của mình.</p>', '[\"https:\\/\\/i.ytimg.com\\/vi\\/jNj0s00U7k4\\/mqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/jNj0s00U7k4\\/hqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/jNj0s00U7k4\\/maxresdefault.jpg\"]', NULL, 1, '2023-09-30 22:50:58', '2023-10-29 07:45:08'),
(15, 'Tạo hiệu ứng chuông thông báo độc đáo với HTML và CSS', 'tao-hieu-ung-chuong-thong-bao-doc-dao-voi-html-va-css', 'aHEByH5h79k', '<p>Trong bài viết này, chúng ta sẽ tìm hiểu cách tạo một hiệu ứng chuông thông báo độc đáo bằng sử dụng HTML và CSS</p>\r\n<h2>Bước 1: Tạo cấu trúc HTML cơ bản</h2>\r\n<p>Chúng ta bắt đầu bằng việc tạo cấu trúc HTML cơ bản cho biểu tượng chuông thông báo. Dưới đây là mã HTML đơn giản:</p>\r\n<pre class=\"language-markup\"><code>&lt;div class=\"icon-wrapper\" data-number=\"1\"&gt;\r\n    &lt;img src=\"./bell-icon.svg\" alt=\"\" class=\"bell-icon\" /&gt;\r\n&lt;/div&gt;</code></pre>\r\n<h2>Bước 2: Thiết lập CSS cho hiệu ứng</h2>\r\n<p>Tiếp theo, chúng ta sẽ sử dụng CSS để tạo hiệu ứng chuông thông báo. Dưới đây là mã CSS:</p>\r\n<pre class=\"language-css\"><code>.icon-wrapper {\r\n    width: 50px;\r\n    height: 50px;\r\n    position: relative;\r\n}\r\n\r\n.icon-wrapper::after {\r\n    content: attr(data-number);\r\n    width: 20px;\r\n    height: 20px;\r\n    background-color: #d32b2b;\r\n    color: #fff;\r\n    display: grid;\r\n    place-content: center;\r\n    border-radius: 50%;\r\n    position: absolute;\r\n    top: 5px;\r\n    right: 0;\r\n    opacity: 0;\r\n    transform: translateY(3px);\r\n}\r\n\r\n.icon-wrapper:hover::after {\r\n    opacity: 1;\r\n    transform: translateY(0);\r\n    transition: opacity 0.25s;\r\n    transform: 0.25s;\r\n}\r\n\r\n.bell-icon {\r\n    max-width: 100%;\r\n}\r\n\r\n.icon-wrapper:hover .bell-icon {\r\n    animation: snake 1s forwards;\r\n}\r\n\r\n@keyframes snake {\r\n    10% {\r\n        transform: rotate(15deg);\r\n    }\r\n    20% {\r\n        transform: rotate(-15deg);\r\n    }\r\n    30% {\r\n        transform: rotate(15deg);\r\n    }\r\n    50% {\r\n        transform: rotate(0deg);\r\n    }\r\n}</code></pre>\r\n<h2>Kết quả</h2>\r\n<p>Hiệu ứng chuông thông báo này sẽ có một số tính năng độc đáo:</p>\r\n<ul style=\"list-style-type: disc;\">\r\n<li>Khi di chuột qua biểu tượng chuông, một vòng tròn màu đỏ hiển thị để số lượng thông báo.</li>\r\n<li>Biểu tượng chuông quay vòng theo kiểu \"rắn\" khi di chuột qua.</li>\r\n</ul>\r\n<p>Với mã HTML và CSS trên, bạn đã tạo được một hiệu ứng chuông thông báo độc đáo sẽ làm cho giao diện người dùng của bạn trở nên thú vị hơn. Bạn có thể tùy chỉnh màu sắc và kích thước theo ý muốn để phù hợp với thiết kế của bạn.</p>\r\n<p>Hy vọng rằng bài viết này đã giúp bạn tạo ra một hiệu ứng chuông thông báo độc đáo cho trang web hoặc ứng dụng của mình.</p>', '[\"https:\\/\\/i.ytimg.com\\/vi\\/aHEByH5h79k\\/mqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/aHEByH5h79k\\/hqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/aHEByH5h79k\\/maxresdefault.jpg\"]', NULL, 1, '2023-09-30 22:52:27', '2024-01-02 19:59:55'),
(16, 'Tạo Hiệu Ứng Zoom Ảnh Một Cách Tự Nhiên với HTML, CSS, và JavaScript', 'tao-hieu-ung-zoom-anh-mot-cach-tu-nhien-voi-html-css-va-javascript', 'WRH4T1FKKAE', '<p>Việc tạo ra hiệu ứng zoom ảnh mà không cần phải dùng đến thư viện là một thách thức thú vị trong lập trình web. Trong bài viết này, chúng ta sẽ tìm hiểu cách tạo một hiệu ứng zoom đơn giản bằng cách sử dụng HTML, CSS, và JavaScript. Điều này sẽ giúp bạn hiểu rõ cách hoạt động của hiệu ứng và có thể tùy chỉnh nó theo ý muốn.</p>\r\n<h2>Bước 1: Tạo Cấu Trúc HTML</h2>\r\n<p>Trước tiên, chúng ta cần tạo cấu trúc HTML cơ bản. Chúng ta sẽ tạo một <code>div</code> với class \"zoom,\" và bên trong nó, chúng ta sẽ đặt hai thẻ <code>img</code>. Thẻ <code>img</code> đầu tiên sẽ hiển thị hình ảnh gốc, trong khi thẻ <code>img</code> thứ hai có ID là \"imgZoom\" sẽ được sử dụng cho hiệu ứng phóng to.</p>\r\n<pre class=\"language-markup\"><code>&lt;div class=\"zoom\"&gt;\r\n    &lt;img src=\"image.jpg\" /&gt;\r\n    &lt;img src=\"image.jpg\" id=\"imgZoom\" /&gt;\r\n&lt;/div&gt;</code></pre>\r\n<h2>Bước 2: Thiết Lập CSS</h2>\r\n<p>Trong phần CSS, chúng ta sẽ tạo hiệu ứng zoom. Class \"zoom\" sẽ có các thuộc tính sau:</p>\r\n<pre class=\"language-css\"><code>.zoom {\r\n    width: max-content;\r\n    position: relative;\r\n}</code></pre>\r\n<p>Thuộc tính <code>width: max-content</code> sẽ đảm bảo rằng khung \"zoom\" có độ rộng vừa đủ để chứa nội dung bên trong. Đối với thẻ <code>img</code> thứ hai (có ID \"imgZoom\"), chúng ta sẽ thiết lập các thuộc tính sau:</p>\r\n<pre class=\"language-css\"><code>#imgZoom {\r\n    position: absolute;\r\n    left: 0;\r\n    transform: scale(1.5);\r\n    pointer-events: none;\r\n    --zoom-x: 50%;\r\n    --zoom-y: 50%;\r\n    clip-path: circle(100px at var(--zoom-x) var(--zoom-y));\r\n    opacity: 0;\r\n}</code></pre>\r\n<ul style=\"list-style-type: disc;\">\r\n<li><code>position: absolute</code> cho phép chúng ta đặt thẻ <code>imgZoom</code> lên trên hình ảnh gốc.</li>\r\n<li><code>transform: scale(1.5)</code> là thuộc tính chúng ta sử dụng để phóng to ảnh 1.5 lần.</li>\r\n<li><code>pointer-events: none</code> ngăn thẻ <code>imgZoom</code> tương tác với con trỏ chuột.</li>\r\n<li><code>clip-path: circle(100px at var(--zoom-x) var(--zoom-y))</code> tạo ra một hình tròn có đường kính 100 pixel tại vị trí đã xác định bằng biến <code>--zoom-x</code> và <code>--zoom-y</code>.</li>\r\n<li><code>opacity: 0</code> để ẩn thẻ <code>imgZoom</code> ban đầu.</li>\r\n</ul>\r\n<h2>Bước 3: JavaScript Cho Hiệu Ứng Zoom</h2>\r\n<p>Bây giờ, chúng ta cần thêm JavaScript để thêm hiệu ứng zoom khi người dùng tương tác.</p>\r\n<pre class=\"language-javascript\"><code>const zoom = document.querySelector(\".zoom\");\r\nconst imgZoom = document.querySelector(\"#imgZoom\");\r\n\r\nzoom.addEventListener(\"mousemove\", (e) =&gt; {\r\n    imgZoom.style.opacity = 1;\r\n\r\n    let positionPx = e.x - zoom.getBoundingClientRect().left;\r\n    let positionX = (positionPx / zoom.offsetWidth) * 100;\r\n\r\n    let positionPy = e.y - zoom.getBoundingClientRect().top;\r\n    let positionY = (positionPy / zoom.offsetHeight) * 100;\r\n\r\n    imgZoom.style.setProperty(\"--zoom-x\", positionX + \"%\");\r\n    imgZoom.style.setProperty(\"--zoom-y\", positionY + \"%\");\r\n});\r\n\r\nzoom.addEventListener(\"mouseout\", () =&gt; {\r\n    imgZoom.style.opacity = 0;\r\n});</code></pre>\r\n<p>Trong đoạn mã JavaScript trên:</p>\r\n<ul style=\"list-style-type: disc;\">\r\n<li>Chúng ta sử dụng sự kiện \"mousemove\" để theo dõi vị trí chuột trên phạm vi \"zoom.\"</li>\r\n<li>Khi chuột di chuyển vào \"zoom,\" chúng ta đặt <code>imgZoom</code> để hiển thị (opacity = 1).</li>\r\n<li>Chúng ta tính toán vị trí của chuột trên phạm vi \"zoom\" và cập nhật biến <code>--zoom-x</code> và <code>--zoom-y</code> để điều chỉnh hiệu ứng zoom theo vị trí chuột.</li>\r\n<li>Khi chuột rời khỏi \"zoom,\" chúng ta ẩn <code>imgZoom</code> (opacity = 0).</li>\r\n</ul>\r\n<p>Kết quả là bạn sẽ có một hiệu ứng zoom ảnh tự nhiên, mà không cần phải sử dụng thư viện ngoại vi. Bạn có thể tùy chỉnh thuộc tính CSS và hiệu ứng theo ý muốn để tạo ra trải nghiệm độc đáo cho người dùng. Chúc bạn thành công trong việc tạo hiệu ứng này!</p>', '[\"https:\\/\\/i.ytimg.com\\/vi\\/WRH4T1FKKAE\\/mqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/WRH4T1FKKAE\\/hqdefault.jpg\",\"https:\\/\\/i.ytimg.com\\/vi\\/WRH4T1FKKAE\\/maxresdefault.jpg\"]', NULL, 1, '2023-09-30 22:53:20', '2024-01-02 20:00:59'),
(17, 'Test upload thumbnail 11', 'test-upload-thumbnail-11', NULL, '<p>sdfgsdfgdsf</p>', NULL, NULL, 0, '2023-09-30 22:54:17', '2023-10-27 08:39:43'),
(18, 'Test upload thumbnail 12', 'test-upload-thumbnail-12', '', '<p>sdfgsdfg</p>', NULL, NULL, 0, '2023-09-30 22:55:26', '2023-10-27 08:39:44'),
(19, 'Test upload thumbnail 13', 'test-upload-thumbnail-13', NULL, '<p>sdfgdsfgs</p>', NULL, NULL, 0, '2023-09-30 22:56:03', '2023-10-27 08:39:46'),
(20, 'Test upload thumbnail 14', 'test-upload-thumbnail-14', NULL, '<p>Test upload thumbnail 14</p>', NULL, NULL, 0, '2023-10-01 08:10:17', '2023-10-27 08:39:48'),
(21, 'Tài liệu học tập 44', 'tai-lieu-hoc-tap-44', NULL, '<p>fffff</p>', NULL, NULL, 0, '2023-10-02 16:08:55', '2023-10-27 08:39:49'),
(22, 'Tài liệu học tập 6 Tài liệu học tập 6', 'tai-lieu-hoc-tap-6-tai-lieu-hoc-tap-6', NULL, '<p>111</p>', NULL, NULL, 0, '2023-10-02 16:17:00', '2023-11-09 11:09:16'),
(23, 'Tài liệu học tập 66', 'tai-lieu-hoc-tap-66', NULL, '<p><img src=\"https://res.cloudinary.com/tudvh/image/upload/v1696317672/trick-lor/post/23/post-description/651bc0e50ce65.jpg\" alt=\"Tài liệu học tập 66\" data-public-id=\"trick-lor/post/23/post-description/651bc0e50ce65\"></p>\r\n<p><img src=\"https://res.cloudinary.com/tudvh/image/upload/v1696317675/trick-lor/post/23/post-description/651bc0e80edef.jpg\" alt=\"Tài liệu học tập 66\" data-public-id=\"trick-lor/post/23/post-description/651bc0e80edef\"></p>\r\n<p><img src=\"https://res.cloudinary.com/tudvh/image/upload/v1696317677/trick-lor/post/23/post-description/651bc0eaa0c27.jpg\" alt=\"Tài liệu học tập 66\" data-public-id=\"trick-lor/post/23/post-description/651bc0eaa0c27\"></p>', NULL, '[\"https:\\/\\/res.cloudinary.com\\/tudvh\\/image\\/upload\\/v1696756068\\/trick-lor\\/post\\/23\\/post-thumbnail\\/mqdefault.jpg\",\"https:\\/\\/res.cloudinary.com\\/tudvh\\/image\\/upload\\/v1696756070\\/trick-lor\\/post\\/23\\/post-thumbnail\\/hqdefault.jpg\",\"https:\\/\\/res.cloudinary.com\\/tudvh\\/image\\/upload\\/v1696756073\\/trick-lor\\/post\\/23\\/post-thumbnail\\/maxresdefault.jpg\"]', 0, '2023-10-02 16:21:00', '2023-11-09 11:09:17'),
(24, 'Test category', 'test-category', NULL, '<p><img src=\"https://res.cloudinary.com/tudvh/image/upload/v1698747299/trick-lor/post/24/post-description/6540d39ab5da2.jpg\" alt=\"Test category\" data-public-id=\"trick-lor/post/24/post-description/6540d39ab5da2\"></p>\r\n<p><img src=\"https://res.cloudinary.com/tudvh/image/upload/v1698754564/trick-lor/post/24/post-description/6540effdf395b.jpg\" data-public-id=\"trick-lor/post/24/post-description/6540effdf395b\" alt=\"Test category\"></p>\r\n<p><img src=\"https://res.cloudinary.com/tudvh/image/upload/v1698754566/trick-lor/post/24/post-description/6540f00486cfd.jpg\" data-public-id=\"trick-lor/post/24/post-description/6540f00486cfd\" alt=\"Test category\"></p>\r\n<p><img src=\"https://res.cloudinary.com/tudvh/image/upload/v1698754568/trick-lor/post/24/post-description/6540f0072cf62.jpg\" data-public-id=\"trick-lor/post/24/post-description/6540f0072cf62\" alt=\"Test category\"></p>', NULL, '[\"https:\\/\\/res.cloudinary.com\\/tudvh\\/image\\/upload\\/v1698747944\\/trick-lor\\/post\\/24\\/post-thumbnail\\/mqdefault.jpg\",\"https:\\/\\/res.cloudinary.com\\/tudvh\\/image\\/upload\\/v1698747946\\/trick-lor\\/post\\/24\\/post-thumbnail\\/hqdefault.jpg\",\"https:\\/\\/res.cloudinary.com\\/tudvh\\/image\\/upload\\/v1698747949\\/trick-lor\\/post\\/24\\/post-thumbnail\\/maxresdefault.jpg\"]', 0, '2023-10-17 09:17:30', '2023-11-09 11:22:28'),
(25, 'Test category 2', 'test-category-2', NULL, '<p>aaaaa</p>', NULL, NULL, 0, '2023-10-17 09:22:52', '2024-01-02 17:13:35'),
(26, 'Test category 3', 'test-category-3', NULL, '<p><img src=\"https://res.cloudinary.com/tudvh/image/upload/v1701868432/trick-lor/post/26/post-description/65707385f2bc3.png\" alt=\"Test category 3\" data-public-id=\"trick-lor/post/26/post-description/65707385f2bc3\"></p>', NULL, NULL, 0, '2023-10-17 09:23:33', '2024-01-02 17:11:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_categories`
--

CREATE TABLE `post_categories` (
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post_categories`
--

INSERT INTO `post_categories` (`post_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 2, '2023-08-18 21:10:37', '2023-08-18 21:10:37'),
(2, 3, '2023-09-23 15:22:59', '2023-09-23 15:22:59'),
(3, 1, '2023-10-03 21:57:03', '2023-10-03 21:57:03'),
(3, 2, '2023-10-03 21:57:03', '2023-10-03 21:57:03'),
(4, 5, '2023-10-07 08:01:26', '2023-10-07 08:01:26'),
(5, 3, '2023-10-09 08:57:04', '2023-10-09 08:57:04'),
(6, 3, '2023-10-09 17:12:54', '2023-10-09 17:12:54'),
(7, 2, '2023-10-12 12:12:33', '2023-10-12 12:12:33'),
(9, 2, '2023-10-15 09:03:44', '2023-10-15 09:03:44'),
(10, 3, '2023-10-15 16:10:06', '2023-10-15 16:10:06'),
(11, 2, '2023-10-18 20:01:16', '2023-10-18 20:01:16'),
(12, 3, '2023-10-19 10:28:44', '2023-10-19 10:28:44'),
(13, 2, '2023-10-27 08:26:49', '2023-10-27 08:26:49'),
(14, 1, '2023-10-27 20:31:57', '2023-10-27 20:31:57'),
(14, 2, '2023-10-27 20:17:59', '2023-10-27 20:17:59'),
(15, 1, '2023-09-30 22:52:27', '2023-09-30 22:52:27'),
(15, 2, '2023-10-28 09:10:50', '2023-10-28 09:10:50'),
(16, 1, '2023-09-30 22:53:20', '2023-09-30 22:53:20'),
(16, 2, '2023-10-29 10:41:17', '2023-10-29 10:41:17'),
(16, 3, '2023-10-29 10:41:17', '2023-10-29 10:41:17'),
(17, 1, '2023-09-30 22:54:17', '2023-09-30 22:54:17'),
(18, 1, '2023-09-30 22:55:26', '2023-09-30 22:55:26'),
(19, 1, '2023-09-30 22:56:03', '2023-09-30 22:56:03'),
(20, 1, '2023-10-01 08:10:17', '2023-10-01 08:10:17'),
(21, 1, '2023-10-02 16:09:15', '2023-10-02 16:09:15'),
(22, 1, '2023-10-02 16:17:00', '2023-10-02 16:17:00'),
(23, 1, '2023-10-02 16:21:00', '2023-10-02 16:21:00'),
(24, 1, '2023-10-17 09:24:40', '2023-10-17 09:24:40'),
(25, 1, '2023-10-17 09:24:24', '2023-10-17 09:24:24'),
(26, 1, '2023-10-17 09:24:47', '2023-10-17 09:24:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_comments`
--

CREATE TABLE `post_comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `reply_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post_comments`
--

INSERT INTO `post_comments` (`id`, `user_id`, `post_id`, `content`, `reply_id`, `created_at`, `updated_at`) VALUES
(1, 5, 16, 'Bổ ích', NULL, '2024-01-03 13:00:41', '2024-01-03 13:00:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_saves`
--

CREATE TABLE `post_saves` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post_saves`
--

INSERT INTO `post_saves` (`user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(5, 3, '2023-11-14 22:28:26', '2023-11-14 22:28:26'),
(5, 5, '2023-11-14 22:24:08', '2023-11-14 22:24:08'),
(5, 6, '2024-01-03 12:40:16', '2024-01-03 12:40:16'),
(5, 10, '2023-11-15 19:15:22', '2023-11-15 19:15:22'),
(5, 15, '2024-01-07 11:11:30', '2024-01-07 11:11:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_views`
--

CREATE TABLE `post_views` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post_views`
--

INSERT INTO `post_views` (`id`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 14, '2023-10-10 22:02:26', '2023-10-10 22:02:26'),
(2, NULL, 14, '2023-10-10 22:02:29', '2023-10-10 22:02:29'),
(3, NULL, 14, '2023-10-10 22:02:31', '2023-10-10 22:02:31'),
(4, NULL, 15, '2023-10-26 22:02:33', '2023-10-26 22:02:33'),
(5, NULL, 15, '2023-10-26 22:02:35', '2023-10-26 22:02:35'),
(6, NULL, 23, '2023-10-26 22:09:20', '2023-10-26 22:09:20'),
(7, NULL, 23, '2023-10-26 22:09:39', '2023-10-26 22:09:39'),
(8, NULL, 13, '2023-10-26 22:09:45', '2023-10-26 22:09:45'),
(9, NULL, 13, '2023-10-27 08:20:43', '2023-10-27 08:20:43'),
(10, 5, 13, '2023-10-27 08:20:55', '2023-10-27 08:20:55'),
(11, 5, 13, '2023-10-27 08:40:10', '2023-10-27 08:40:10'),
(12, 5, 13, '2023-10-27 09:56:11', '2023-10-27 09:56:11'),
(13, 5, 1, '2023-10-27 10:02:17', '2023-10-27 10:02:17'),
(14, 5, 1, '2023-10-27 10:02:19', '2023-10-27 10:02:19'),
(15, 5, 1, '2023-10-27 10:18:37', '2023-10-27 10:18:37'),
(16, 5, 1, '2023-10-27 10:19:06', '2023-10-27 10:19:06'),
(17, 5, 2, '2023-10-27 10:20:12', '2023-10-27 10:20:12'),
(18, 5, 2, '2023-10-27 10:20:14', '2023-10-27 10:20:14'),
(19, 5, 13, '2023-10-27 11:18:28', '2023-10-27 11:18:28'),
(20, 5, 13, '2023-10-27 11:19:16', '2023-10-27 11:19:16'),
(21, 5, 13, '2023-10-27 11:19:38', '2023-10-27 11:19:38'),
(22, 5, 13, '2023-10-27 11:20:13', '2023-10-27 11:20:13'),
(23, 5, 13, '2023-10-27 11:20:32', '2023-10-27 11:20:32'),
(24, 5, 13, '2023-10-27 11:20:46', '2023-10-27 11:20:46'),
(25, 5, 13, '2023-10-27 11:20:55', '2023-10-27 11:20:55'),
(26, 5, 13, '2023-10-27 11:21:26', '2023-10-27 11:21:26'),
(27, 5, 13, '2023-10-27 11:22:43', '2023-10-27 11:22:43'),
(28, 5, 13, '2023-10-27 11:23:23', '2023-10-27 11:23:23'),
(29, 5, 13, '2023-10-27 11:23:36', '2023-10-27 11:23:36'),
(30, 5, 3, '2023-10-27 11:38:31', '2023-10-27 11:38:31'),
(31, 5, 4, '2023-10-27 11:44:38', '2023-10-27 11:44:38'),
(32, 5, 5, '2023-10-27 12:03:03', '2023-10-27 12:03:03'),
(33, 5, 5, '2023-10-27 12:03:05', '2023-10-27 12:03:05'),
(34, NULL, 6, '2023-10-27 19:38:08', '2023-10-27 19:38:08'),
(35, NULL, 7, '2023-10-27 19:52:21', '2023-10-27 19:52:21'),
(36, NULL, 7, '2023-10-27 19:52:23', '2023-10-27 19:52:23'),
(37, NULL, 10, '2023-10-27 20:29:38', '2023-10-27 20:29:38'),
(38, NULL, 2, '2023-10-27 20:44:36', '2023-10-27 20:44:36'),
(39, NULL, 2, '2023-10-27 20:44:53', '2023-10-27 20:44:53'),
(40, NULL, 11, '2023-10-27 20:44:59', '2023-10-27 20:44:59'),
(41, NULL, 11, '2023-10-27 20:46:00', '2023-10-27 20:46:00'),
(42, NULL, 12, '2023-10-27 20:46:35', '2023-10-27 20:46:35'),
(43, NULL, 14, '2023-10-27 20:47:28', '2023-10-27 20:47:28'),
(44, NULL, 3, '2023-10-28 09:25:45', '2023-10-28 09:25:45'),
(45, NULL, 4, '2023-10-28 09:36:10', '2023-10-28 09:36:10'),
(46, NULL, 1, '2023-10-28 10:52:18', '2023-10-28 10:52:18'),
(47, NULL, 1, '2023-10-28 10:52:20', '2023-10-28 10:52:20'),
(48, NULL, 13, '2023-10-28 11:44:53', '2023-10-28 11:44:53'),
(49, NULL, 15, '2023-10-28 14:15:48', '2023-10-28 14:15:48'),
(50, NULL, 1, '2023-10-28 14:16:04', '2023-10-28 14:16:04'),
(51, NULL, 6, '2023-10-28 16:28:17', '2023-10-28 16:28:17'),
(52, NULL, 10, '2023-10-28 17:02:23', '2023-10-28 17:02:23'),
(53, NULL, 12, '2023-10-28 19:18:31', '2023-10-28 19:18:31'),
(54, NULL, 12, '2023-10-28 19:18:34', '2023-10-28 19:18:34'),
(55, NULL, 7, '2023-10-28 20:03:31', '2023-10-28 20:03:31'),
(56, NULL, 5, '2023-10-29 07:12:28', '2023-10-29 07:12:28'),
(57, NULL, 5, '2023-10-29 07:12:31', '2023-10-29 07:12:31'),
(58, NULL, 11, '2023-10-29 07:44:38', '2023-10-29 07:44:38'),
(59, NULL, 14, '2023-10-29 07:45:31', '2023-10-29 07:45:31'),
(60, NULL, 14, '2023-10-29 07:45:33', '2023-10-29 07:45:33'),
(61, NULL, 3, '2023-10-29 09:14:16', '2023-10-29 09:14:16'),
(62, NULL, 2, '2023-10-29 10:36:25', '2023-10-29 10:36:25'),
(95, NULL, 13, '2023-10-29 11:47:46', '2023-10-29 11:47:46'),
(96, NULL, 6, '2023-10-29 12:02:35', '2023-10-29 12:02:35'),
(97, NULL, 10, '2023-10-29 12:05:53', '2023-10-29 12:05:53'),
(98, NULL, 3, '2023-10-29 12:11:19', '2023-10-29 12:11:19'),
(99, NULL, 15, '2023-10-29 14:25:02', '2023-10-29 14:25:02'),
(100, NULL, 16, '2023-10-29 14:25:41', '2023-10-29 14:25:41'),
(101, NULL, 16, '2023-10-29 15:05:08', '2023-10-29 15:05:08'),
(102, NULL, 1, '2023-10-29 19:35:32', '2023-10-29 19:35:32'),
(103, NULL, 6, '2023-10-30 07:29:36', '2023-10-30 07:29:36'),
(104, NULL, 9, '2023-10-30 07:29:49', '2023-10-30 07:29:49'),
(105, NULL, 9, '2023-10-30 07:29:52', '2023-10-30 07:29:52'),
(106, NULL, 7, '2023-10-30 09:26:49', '2023-10-30 09:26:49'),
(107, NULL, 7, '2023-10-30 09:26:51', '2023-10-30 09:26:51'),
(108, NULL, 12, '2023-10-30 12:25:10', '2023-10-30 12:25:10'),
(109, NULL, 12, '2023-10-30 12:25:14', '2023-10-30 12:25:14'),
(110, NULL, 16, '2023-10-30 15:26:24', '2023-10-30 15:26:24'),
(111, NULL, 9, '2023-10-30 15:59:49', '2023-10-30 15:59:49'),
(112, 5, 11, '2023-10-30 16:25:39', '2023-10-30 16:25:39'),
(113, NULL, 16, '2023-10-30 19:03:33', '2023-10-30 19:03:33'),
(114, 5, 9, '2023-10-30 20:17:21', '2023-10-30 20:17:21'),
(115, 5, 10, '2023-10-30 20:18:43', '2023-10-30 20:18:43'),
(116, 5, 10, '2023-10-30 20:18:46', '2023-10-30 20:18:46'),
(117, 5, 15, '2023-10-30 20:20:27', '2023-10-30 20:20:27'),
(118, 5, 15, '2023-10-30 20:20:29', '2023-10-30 20:20:29'),
(119, NULL, 6, '2023-10-31 07:28:31', '2023-10-31 07:28:31'),
(120, NULL, 9, '2023-10-31 08:49:26', '2023-10-31 08:49:26'),
(121, NULL, 11, '2023-10-31 10:09:16', '2023-10-31 10:09:16'),
(122, NULL, 11, '2023-10-31 10:09:30', '2023-10-31 10:09:30'),
(123, NULL, 5, '2023-10-31 10:24:59', '2023-10-31 10:24:59'),
(124, NULL, 4, '2023-10-31 10:35:39', '2023-10-31 10:35:39'),
(125, NULL, 4, '2023-10-31 10:35:44', '2023-10-31 10:35:44'),
(126, 5, 11, '2023-10-31 10:36:21', '2023-10-31 10:36:21'),
(127, NULL, 4, '2023-10-31 10:36:45', '2023-10-31 10:36:45'),
(128, 5, 4, '2023-10-31 10:37:00', '2023-10-31 10:37:00'),
(138, 5, 15, '2023-10-31 19:22:02', '2023-10-31 19:22:02'),
(139, NULL, 16, '2023-11-03 09:15:21', '2023-11-03 09:15:21'),
(140, NULL, 16, '2023-11-03 09:15:25', '2023-11-03 09:15:25'),
(141, NULL, 13, '2023-11-06 20:17:42', '2023-11-06 20:17:42'),
(142, NULL, 13, '2023-11-06 20:17:58', '2023-11-06 20:17:58'),
(143, NULL, 6, '2023-11-07 10:02:32', '2023-11-07 10:02:32'),
(144, NULL, 6, '2023-11-07 10:02:35', '2023-11-07 10:02:35'),
(145, 5, 7, '2023-11-07 11:12:38', '2023-11-07 11:12:38'),
(146, 5, 7, '2023-11-07 11:12:40', '2023-11-07 11:12:40'),
(147, NULL, 9, '2023-11-07 21:18:26', '2023-11-07 21:18:26'),
(148, NULL, 2, '2023-11-08 12:03:21', '2023-11-08 12:03:21'),
(149, NULL, 2, '2023-11-08 12:09:08', '2023-11-08 12:09:08'),
(150, NULL, 2, '2023-11-08 12:10:32', '2023-11-08 12:10:32'),
(151, NULL, 2, '2023-11-08 12:11:11', '2023-11-08 12:11:11'),
(152, NULL, 2, '2023-11-08 12:11:15', '2023-11-08 12:11:15'),
(153, NULL, 2, '2023-11-08 12:11:29', '2023-11-08 12:11:29'),
(154, NULL, 2, '2023-11-08 12:11:35', '2023-11-08 12:11:35'),
(155, NULL, 2, '2023-11-08 12:11:41', '2023-11-08 12:11:41'),
(156, NULL, 2, '2023-11-08 12:11:55', '2023-11-08 12:11:55'),
(157, NULL, 2, '2023-11-08 12:12:17', '2023-11-08 12:12:17'),
(158, NULL, 5, '2023-11-08 12:12:26', '2023-11-08 12:12:26'),
(159, NULL, 15, '2023-11-08 12:13:53', '2023-11-08 12:13:53'),
(160, 5, 15, '2023-11-08 12:15:00', '2023-11-08 12:15:00'),
(161, 5, 3, '2023-11-08 19:58:01', '2023-11-08 19:58:01'),
(162, 5, 14, '2023-11-08 21:59:54', '2023-11-08 21:59:54'),
(163, 5, 14, '2023-11-08 21:59:57', '2023-11-08 21:59:57'),
(164, NULL, 4, '2023-11-09 10:24:40', '2023-11-09 10:24:40'),
(165, NULL, 4, '2023-11-09 10:24:42', '2023-11-09 10:24:42'),
(166, 5, 4, '2023-11-09 10:24:52', '2023-11-09 10:24:52'),
(167, 5, 5, '2023-11-09 10:49:09', '2023-11-09 10:49:09'),
(168, 5, 5, '2023-11-09 10:49:11', '2023-11-09 10:49:11'),
(169, 5, 5, '2023-11-09 10:49:13', '2023-11-09 10:49:13'),
(170, 5, 5, '2023-11-09 10:49:17', '2023-11-09 10:49:17'),
(171, 5, 5, '2023-11-09 10:49:20', '2023-11-09 10:49:20'),
(172, 5, 5, '2023-11-09 10:49:23', '2023-11-09 10:49:23'),
(173, 5, 5, '2023-11-09 10:49:27', '2023-11-09 10:49:27'),
(174, 5, 5, '2023-11-09 10:49:31', '2023-11-09 10:49:31'),
(175, 5, 5, '2023-11-09 10:49:33', '2023-11-09 10:49:33'),
(176, 5, 16, '2023-11-09 11:03:50', '2023-11-09 11:03:50'),
(177, 5, 5, '2023-11-09 11:08:41', '2023-11-09 11:08:41'),
(178, 5, 4, '2023-11-09 11:08:53', '2023-11-09 11:08:53'),
(179, 5, 2, '2023-11-09 11:09:30', '2023-11-09 11:09:30'),
(180, 5, 2, '2023-11-09 11:09:34', '2023-11-09 11:09:34'),
(181, 5, 2, '2023-11-09 11:13:58', '2023-11-09 11:13:58'),
(182, 5, 2, '2023-11-09 11:14:03', '2023-11-09 11:14:03'),
(183, 5, 2, '2023-11-09 11:14:06', '2023-11-09 11:14:06'),
(184, 5, 2, '2023-11-09 11:14:09', '2023-11-09 11:14:09'),
(185, 5, 2, '2023-11-09 11:14:13', '2023-11-09 11:14:13'),
(186, 5, 2, '2023-11-09 11:14:16', '2023-11-09 11:14:16'),
(187, 5, 2, '2023-11-09 11:14:18', '2023-11-09 11:14:18'),
(188, 5, 2, '2023-11-09 11:14:27', '2023-11-09 11:14:27'),
(189, 5, 2, '2023-11-09 11:17:10', '2023-11-09 11:17:10'),
(190, 5, 2, '2023-11-09 11:17:12', '2023-11-09 11:17:12'),
(191, 5, 2, '2023-11-09 11:17:13', '2023-11-09 11:17:13'),
(192, 5, 2, '2023-11-09 11:17:16', '2023-11-09 11:17:16'),
(193, 5, 2, '2023-11-09 11:17:18', '2023-11-09 11:17:18'),
(194, 5, 1, '2023-11-09 11:21:16', '2023-11-09 11:21:16'),
(195, 5, 6, '2023-11-09 11:35:14', '2023-11-09 11:35:14'),
(196, 5, 6, '2023-11-09 11:35:17', '2023-11-09 11:35:17'),
(197, 5, 13, '2023-11-09 12:33:22', '2023-11-09 12:33:22'),
(198, 5, 4, '2023-11-09 19:47:43', '2023-11-09 19:47:43'),
(199, 5, 14, '2023-11-09 19:47:50', '2023-11-09 19:47:50'),
(200, 5, 14, '2023-11-09 19:47:53', '2023-11-09 19:47:53'),
(201, 5, 16, '2023-11-09 19:47:58', '2023-11-09 19:47:58'),
(202, 5, 16, '2023-11-09 19:49:28', '2023-11-09 19:49:28'),
(203, 5, 16, '2023-11-09 19:51:52', '2023-11-09 19:51:52'),
(204, 5, 16, '2023-11-09 19:52:06', '2023-11-09 19:52:06'),
(205, 5, 16, '2023-11-09 19:53:22', '2023-11-09 19:53:22'),
(206, 5, 16, '2023-11-09 19:53:53', '2023-11-09 19:53:53'),
(207, 5, 16, '2023-11-09 19:54:22', '2023-11-09 19:54:22'),
(208, 5, 16, '2023-11-09 19:54:27', '2023-11-09 19:54:27'),
(209, 5, 16, '2023-11-09 19:57:21', '2023-11-09 19:57:21'),
(210, 5, 16, '2023-11-09 19:59:59', '2023-11-09 19:59:59'),
(211, 5, 12, '2023-11-09 21:05:45', '2023-11-09 21:05:45'),
(212, 5, 12, '2023-11-09 21:05:48', '2023-11-09 21:05:48'),
(213, 5, 2, '2023-11-09 21:06:24', '2023-11-09 21:06:24'),
(214, 5, 2, '2023-11-09 21:06:28', '2023-11-09 21:06:28'),
(215, 5, 15, '2023-11-09 21:06:35', '2023-11-09 21:06:35'),
(216, 5, 15, '2023-11-09 21:06:37', '2023-11-09 21:06:37'),
(217, 5, 11, '2023-11-09 21:13:13', '2023-11-09 21:13:13'),
(218, 5, 11, '2023-11-09 21:13:15', '2023-11-09 21:13:15'),
(219, 5, 11, '2023-11-09 21:21:58', '2023-11-09 21:21:58'),
(220, 5, 15, '2023-11-09 21:22:34', '2023-11-09 21:22:34'),
(221, 5, 9, '2023-11-09 21:47:58', '2023-11-09 21:47:58'),
(222, 5, 9, '2023-11-09 21:48:33', '2023-11-09 21:48:33'),
(223, 5, 1, '2023-11-09 21:49:01', '2023-11-09 21:49:01'),
(224, NULL, 16, '2023-11-12 10:13:51', '2023-11-12 10:13:51'),
(225, NULL, 16, '2023-11-12 21:33:26', '2023-11-12 21:33:26'),
(226, NULL, 12, '2023-11-12 21:33:51', '2023-11-12 21:33:51'),
(227, NULL, 12, '2023-11-12 21:33:54', '2023-11-12 21:33:54'),
(228, 5, 6, '2023-11-14 07:57:36', '2023-11-14 07:57:36'),
(229, 5, 6, '2023-11-14 07:57:38', '2023-11-14 07:57:38'),
(230, NULL, 12, '2023-11-14 15:43:32', '2023-11-14 15:43:32'),
(231, NULL, 12, '2023-11-14 15:43:35', '2023-11-14 15:43:35'),
(232, 5, 12, '2023-11-14 15:50:35', '2023-11-14 15:50:35'),
(233, 5, 10, '2023-11-14 16:03:45', '2023-11-14 16:03:45'),
(234, 5, 3, '2023-11-14 16:04:21', '2023-11-14 16:04:21'),
(235, 5, 3, '2023-11-14 16:15:30', '2023-11-14 16:15:30'),
(236, 5, 3, '2023-11-14 16:37:05', '2023-11-14 16:37:05'),
(237, 5, 3, '2023-11-14 16:46:53', '2023-11-14 16:46:53'),
(238, 5, 3, '2023-11-14 16:47:16', '2023-11-14 16:47:16'),
(239, 5, 3, '2023-11-14 16:47:26', '2023-11-14 16:47:26'),
(240, 5, 3, '2023-11-14 16:48:23', '2023-11-14 16:48:23'),
(241, 5, 3, '2023-11-14 16:58:16', '2023-11-14 16:58:16'),
(242, 5, 3, '2023-11-14 16:58:30', '2023-11-14 16:58:30'),
(243, 5, 3, '2023-11-14 16:59:22', '2023-11-14 16:59:22'),
(244, 5, 3, '2023-11-14 17:00:08', '2023-11-14 17:00:08'),
(245, 5, 3, '2023-11-14 17:00:34', '2023-11-14 17:00:34'),
(246, 5, 3, '2023-11-14 17:00:50', '2023-11-14 17:00:50'),
(247, 5, 3, '2023-11-14 17:01:07', '2023-11-14 17:01:07'),
(248, 5, 3, '2023-11-14 17:01:23', '2023-11-14 17:01:23'),
(249, NULL, 3, '2023-11-14 17:03:48', '2023-11-14 17:03:48'),
(250, 5, 3, '2023-11-14 17:03:54', '2023-11-14 17:03:54'),
(251, 5, 3, '2023-11-14 17:05:01', '2023-11-14 17:05:01'),
(252, 5, 3, '2023-11-14 17:06:22', '2023-11-14 17:06:22'),
(253, 5, 3, '2023-11-14 17:07:00', '2023-11-14 17:07:00'),
(254, 5, 7, '2023-11-14 17:07:07', '2023-11-14 17:07:07'),
(255, 5, 7, '2023-11-14 17:07:09', '2023-11-14 17:07:09'),
(256, 5, 7, '2023-11-14 17:09:14', '2023-11-14 17:09:14'),
(257, 5, 7, '2023-11-14 17:09:55', '2023-11-14 17:09:55'),
(258, 5, 7, '2023-11-14 17:11:26', '2023-11-14 17:11:26'),
(259, 5, 7, '2023-11-14 17:12:01', '2023-11-14 17:12:01'),
(260, 5, 7, '2023-11-14 17:12:19', '2023-11-14 17:12:19'),
(261, 5, 7, '2023-11-14 17:14:28', '2023-11-14 17:14:28'),
(262, 5, 7, '2023-11-14 17:14:57', '2023-11-14 17:14:57'),
(263, 5, 2, '2023-11-14 17:15:58', '2023-11-14 17:15:58'),
(264, 5, 3, '2023-11-14 17:16:04', '2023-11-14 17:16:04'),
(265, 5, 7, '2023-11-14 17:19:24', '2023-11-14 17:19:24'),
(266, 5, 7, '2023-11-14 17:19:32', '2023-11-14 17:19:32'),
(267, 5, 7, '2023-11-14 17:20:07', '2023-11-14 17:20:07'),
(268, 5, 7, '2023-11-14 17:20:13', '2023-11-14 17:20:13'),
(269, 5, 7, '2023-11-14 17:21:09', '2023-11-14 17:21:09'),
(270, 5, 7, '2023-11-14 17:21:50', '2023-11-14 17:21:50'),
(271, 5, 7, '2023-11-14 17:22:07', '2023-11-14 17:22:07'),
(272, 5, 7, '2023-11-14 17:27:59', '2023-11-14 17:27:59'),
(273, 5, 7, '2023-11-14 17:28:13', '2023-11-14 17:28:13'),
(274, 5, 7, '2023-11-14 17:28:52', '2023-11-14 17:28:52'),
(275, 5, 7, '2023-11-14 17:30:00', '2023-11-14 17:30:00'),
(276, 5, 7, '2023-11-14 17:30:33', '2023-11-14 17:30:33'),
(277, 5, 7, '2023-11-14 17:30:54', '2023-11-14 17:30:54'),
(278, NULL, 9, '2023-11-14 20:06:05', '2023-11-14 20:06:05'),
(279, NULL, 9, '2023-11-14 20:06:07', '2023-11-14 20:06:07'),
(280, NULL, 9, '2023-11-14 20:13:51', '2023-11-14 20:13:51'),
(281, NULL, 9, '2023-11-14 20:13:56', '2023-11-14 20:13:56'),
(282, NULL, 9, '2023-11-14 20:14:29', '2023-11-14 20:14:29'),
(283, NULL, 9, '2023-11-14 20:14:49', '2023-11-14 20:14:49'),
(284, NULL, 9, '2023-11-14 20:16:06', '2023-11-14 20:16:06'),
(285, NULL, 9, '2023-11-14 20:16:17', '2023-11-14 20:16:17'),
(286, NULL, 9, '2023-11-14 20:16:24', '2023-11-14 20:16:24'),
(287, NULL, 9, '2023-11-14 20:16:49', '2023-11-14 20:16:49'),
(288, NULL, 9, '2023-11-14 20:17:02', '2023-11-14 20:17:02'),
(289, NULL, 9, '2023-11-14 20:17:35', '2023-11-14 20:17:35'),
(290, NULL, 9, '2023-11-14 20:17:45', '2023-11-14 20:17:45'),
(291, NULL, 9, '2023-11-14 20:20:29', '2023-11-14 20:20:29'),
(292, NULL, 9, '2023-11-14 20:20:41', '2023-11-14 20:20:41'),
(293, NULL, 9, '2023-11-14 20:20:49', '2023-11-14 20:20:49'),
(294, NULL, 9, '2023-11-14 20:36:02', '2023-11-14 20:36:02'),
(295, NULL, 9, '2023-11-14 20:37:10', '2023-11-14 20:37:10'),
(296, NULL, 9, '2023-11-14 20:37:38', '2023-11-14 20:37:38'),
(297, NULL, 9, '2023-11-14 20:38:13', '2023-11-14 20:38:13'),
(298, NULL, 9, '2023-11-14 20:39:55', '2023-11-14 20:39:55'),
(299, NULL, 9, '2023-11-14 20:40:05', '2023-11-14 20:40:05'),
(300, NULL, 9, '2023-11-14 20:40:21', '2023-11-14 20:40:21'),
(301, NULL, 9, '2023-11-14 20:40:50', '2023-11-14 20:40:50'),
(302, NULL, 9, '2023-11-14 20:40:58', '2023-11-14 20:40:58'),
(303, NULL, 9, '2023-11-14 20:40:59', '2023-11-14 20:40:59'),
(304, NULL, 9, '2023-11-14 20:41:00', '2023-11-14 20:41:00'),
(305, NULL, 9, '2023-11-14 20:41:15', '2023-11-14 20:41:15'),
(306, NULL, 9, '2023-11-14 20:41:36', '2023-11-14 20:41:36'),
(307, NULL, 9, '2023-11-14 20:41:46', '2023-11-14 20:41:46'),
(308, NULL, 9, '2023-11-14 20:42:03', '2023-11-14 20:42:03'),
(309, NULL, 9, '2023-11-14 20:42:13', '2023-11-14 20:42:13'),
(310, NULL, 9, '2023-11-14 20:42:26', '2023-11-14 20:42:26'),
(311, NULL, 9, '2023-11-14 20:42:32', '2023-11-14 20:42:32'),
(312, NULL, 9, '2023-11-14 20:43:10', '2023-11-14 20:43:10'),
(313, NULL, 9, '2023-11-14 20:43:37', '2023-11-14 20:43:37'),
(314, NULL, 9, '2023-11-14 20:44:29', '2023-11-14 20:44:29'),
(315, NULL, 9, '2023-11-14 20:45:36', '2023-11-14 20:45:36'),
(316, NULL, 9, '2023-11-14 20:45:47', '2023-11-14 20:45:47'),
(317, NULL, 9, '2023-11-14 20:46:20', '2023-11-14 20:46:20'),
(318, NULL, 9, '2023-11-14 20:46:40', '2023-11-14 20:46:40'),
(319, NULL, 9, '2023-11-14 20:47:32', '2023-11-14 20:47:32'),
(320, NULL, 9, '2023-11-14 20:47:48', '2023-11-14 20:47:48'),
(321, NULL, 9, '2023-11-14 20:48:35', '2023-11-14 20:48:35'),
(322, NULL, 9, '2023-11-14 20:49:52', '2023-11-14 20:49:52'),
(323, NULL, 9, '2023-11-14 20:50:47', '2023-11-14 20:50:47'),
(324, NULL, 9, '2023-11-14 20:51:53', '2023-11-14 20:51:53'),
(325, NULL, 9, '2023-11-14 20:53:24', '2023-11-14 20:53:24'),
(326, NULL, 9, '2023-11-14 20:54:10', '2023-11-14 20:54:10'),
(327, NULL, 9, '2023-11-14 20:54:18', '2023-11-14 20:54:18'),
(328, NULL, 9, '2023-11-14 20:54:25', '2023-11-14 20:54:25'),
(329, NULL, 9, '2023-11-14 20:55:18', '2023-11-14 20:55:18'),
(330, NULL, 9, '2023-11-14 20:56:17', '2023-11-14 20:56:17'),
(331, NULL, 9, '2023-11-14 20:56:28', '2023-11-14 20:56:28'),
(332, NULL, 9, '2023-11-14 21:02:55', '2023-11-14 21:02:55'),
(333, NULL, 9, '2023-11-14 21:03:38', '2023-11-14 21:03:38'),
(334, NULL, 9, '2023-11-14 21:09:19', '2023-11-14 21:09:19'),
(335, NULL, 9, '2023-11-14 21:09:38', '2023-11-14 21:09:38'),
(336, NULL, 9, '2023-11-14 21:11:16', '2023-11-14 21:11:16'),
(337, NULL, 9, '2023-11-14 21:13:40', '2023-11-14 21:13:40'),
(338, NULL, 9, '2023-11-14 21:15:52', '2023-11-14 21:15:52'),
(339, NULL, 9, '2023-11-14 21:16:17', '2023-11-14 21:16:17'),
(340, NULL, 9, '2023-11-14 21:26:30', '2023-11-14 21:26:30'),
(341, NULL, 1, '2023-11-14 21:26:41', '2023-11-14 21:26:41'),
(342, NULL, 1, '2023-11-14 21:28:09', '2023-11-14 21:28:09'),
(343, NULL, 1, '2023-11-14 21:29:38', '2023-11-14 21:29:38'),
(344, NULL, 1, '2023-11-14 21:30:24', '2023-11-14 21:30:24'),
(345, NULL, 1, '2023-11-14 21:31:00', '2023-11-14 21:31:00'),
(346, NULL, 1, '2023-11-14 21:31:09', '2023-11-14 21:31:09'),
(347, NULL, 1, '2023-11-14 21:32:27', '2023-11-14 21:32:27'),
(348, 5, 1, '2023-11-14 21:32:37', '2023-11-14 21:32:37'),
(349, 5, 1, '2023-11-14 21:33:27', '2023-11-14 21:33:27'),
(350, 5, 1, '2023-11-14 21:33:33', '2023-11-14 21:33:33'),
(351, 5, 1, '2023-11-14 21:33:47', '2023-11-14 21:33:47'),
(352, 5, 1, '2023-11-14 21:34:03', '2023-11-14 21:34:03'),
(353, 5, 1, '2023-11-14 21:34:41', '2023-11-14 21:34:41'),
(354, 5, 1, '2023-11-14 21:47:00', '2023-11-14 21:47:00'),
(355, 5, 1, '2023-11-14 21:51:26', '2023-11-14 21:51:26'),
(356, 5, 1, '2023-11-14 21:52:15', '2023-11-14 21:52:15'),
(357, 5, 1, '2023-11-14 21:52:24', '2023-11-14 21:52:24'),
(358, 5, 1, '2023-11-14 21:52:38', '2023-11-14 21:52:38'),
(359, 5, 1, '2023-11-14 21:55:25', '2023-11-14 21:55:25'),
(360, 5, 1, '2023-11-14 21:55:40', '2023-11-14 21:55:40'),
(361, 5, 1, '2023-11-14 21:55:52', '2023-11-14 21:55:52'),
(362, 5, 1, '2023-11-14 21:57:46', '2023-11-14 21:57:46'),
(363, 5, 1, '2023-11-14 21:57:52', '2023-11-14 21:57:52'),
(364, 5, 1, '2023-11-14 21:58:32', '2023-11-14 21:58:32'),
(365, 5, 1, '2023-11-14 21:58:37', '2023-11-14 21:58:37'),
(366, 5, 1, '2023-11-14 21:59:50', '2023-11-14 21:59:50'),
(367, 5, 1, '2023-11-14 22:01:45', '2023-11-14 22:01:45'),
(368, 5, 1, '2023-11-14 22:01:57', '2023-11-14 22:01:57'),
(369, 5, 1, '2023-11-14 22:02:16', '2023-11-14 22:02:16'),
(370, 5, 1, '2023-11-14 22:02:43', '2023-11-14 22:02:43'),
(371, 5, 1, '2023-11-14 22:02:58', '2023-11-14 22:02:58'),
(372, 5, 1, '2023-11-14 22:03:43', '2023-11-14 22:03:43'),
(373, 5, 1, '2023-11-14 22:03:54', '2023-11-14 22:03:54'),
(374, 5, 1, '2023-11-14 22:04:18', '2023-11-14 22:04:18'),
(375, 5, 1, '2023-11-14 22:04:41', '2023-11-14 22:04:41'),
(376, 5, 1, '2023-11-14 22:05:03', '2023-11-14 22:05:03'),
(377, 5, 1, '2023-11-14 22:05:18', '2023-11-14 22:05:18'),
(378, 5, 1, '2023-11-14 22:05:32', '2023-11-14 22:05:32'),
(379, 5, 5, '2023-11-14 22:13:32', '2023-11-14 22:13:32'),
(380, 5, 5, '2023-11-14 22:13:34', '2023-11-14 22:13:34'),
(381, 5, 5, '2023-11-14 22:14:54', '2023-11-14 22:14:54'),
(382, 5, 5, '2023-11-14 22:15:19', '2023-11-14 22:15:19'),
(383, 5, 5, '2023-11-14 22:15:31', '2023-11-14 22:15:31'),
(384, 5, 5, '2023-11-14 22:15:44', '2023-11-14 22:15:44'),
(385, 5, 5, '2023-11-14 22:17:00', '2023-11-14 22:17:00'),
(386, 5, 5, '2023-11-14 22:17:26', '2023-11-14 22:17:26'),
(387, 5, 5, '2023-11-14 22:17:58', '2023-11-14 22:17:58'),
(388, 5, 5, '2023-11-14 22:19:08', '2023-11-14 22:19:08'),
(389, 5, 5, '2023-11-14 22:19:14', '2023-11-14 22:19:14'),
(390, 5, 5, '2023-11-14 22:19:57', '2023-11-14 22:19:57'),
(391, 5, 5, '2023-11-14 22:20:56', '2023-11-14 22:20:56'),
(392, 5, 5, '2023-11-14 22:21:11', '2023-11-14 22:21:11'),
(393, 5, 5, '2023-11-14 22:24:01', '2023-11-14 22:24:01'),
(394, 5, 5, '2023-11-14 22:28:05', '2023-11-14 22:28:05'),
(395, 5, 3, '2023-11-14 22:28:23', '2023-11-14 22:28:23'),
(396, 5, 15, '2023-11-14 23:24:06', '2023-11-14 23:24:06'),
(397, 5, 15, '2023-11-14 23:24:08', '2023-11-14 23:24:08'),
(398, NULL, 10, '2023-11-15 19:14:44', '2023-11-15 19:14:44'),
(399, NULL, 10, '2023-11-15 19:14:47', '2023-11-15 19:14:47'),
(400, 5, 10, '2023-11-15 19:15:12', '2023-11-15 19:15:12'),
(401, 5, 14, '2023-11-20 09:24:25', '2023-11-20 09:24:25'),
(402, 5, 14, '2023-11-20 09:24:27', '2023-11-20 09:24:27'),
(403, NULL, 15, '2023-11-22 09:17:45', '2023-11-22 09:17:45'),
(404, NULL, 15, '2023-11-22 09:17:48', '2023-11-22 09:17:48'),
(405, 5, 15, '2023-11-22 09:18:00', '2023-11-22 09:18:00'),
(406, 5, 5, '2023-11-22 09:18:12', '2023-11-22 09:18:12'),
(407, 5, 5, '2023-11-22 09:18:14', '2023-11-22 09:18:14'),
(408, 5, 10, '2023-11-22 09:18:17', '2023-11-22 09:18:17'),
(409, 5, 4, '2023-11-22 09:18:21', '2023-11-22 09:18:21'),
(410, 5, 4, '2023-11-22 09:18:23', '2023-11-22 09:18:23'),
(411, 5, 10, '2023-11-22 09:19:25', '2023-11-22 09:19:25'),
(412, NULL, 14, '2023-11-26 08:01:51', '2023-11-26 08:01:51'),
(413, 5, 14, '2023-11-26 08:02:25', '2023-11-26 08:02:25'),
(415, NULL, 10, '2023-11-26 08:05:03', '2023-11-26 08:05:03'),
(416, NULL, 12, '2023-11-26 08:06:43', '2023-11-26 08:06:43'),
(417, 5, 14, '2023-11-26 08:17:35', '2023-11-26 08:17:35'),
(418, 5, 5, '2023-11-26 10:53:26', '2023-11-26 10:53:26'),
(419, 5, 14, '2023-11-26 10:54:29', '2023-11-26 10:54:29'),
(420, 5, 14, '2023-11-26 10:56:11', '2023-11-26 10:56:11'),
(421, 5, 16, '2023-11-26 12:42:04', '2023-11-26 12:42:04'),
(422, 5, 16, '2023-11-26 12:43:11', '2023-11-26 12:43:11'),
(423, 5, 16, '2023-11-26 12:43:15', '2023-11-26 12:43:15'),
(424, 5, 16, '2023-11-26 12:43:35', '2023-11-26 12:43:35'),
(425, 5, 16, '2023-11-26 12:44:12', '2023-11-26 12:44:12'),
(426, 5, 16, '2023-11-26 14:21:42', '2023-11-26 14:21:42'),
(427, 5, 16, '2023-11-26 14:37:06', '2023-11-26 14:37:06'),
(428, 5, 16, '2023-11-26 15:11:48', '2023-11-26 15:11:48'),
(429, 5, 4, '2023-11-26 15:18:11', '2023-11-26 15:18:11'),
(430, 5, 4, '2023-11-26 15:18:16', '2023-11-26 15:18:16'),
(431, 5, 4, '2023-11-26 15:18:21', '2023-11-26 15:18:21'),
(432, 5, 16, '2023-11-26 15:19:55', '2023-11-26 15:19:55'),
(433, 5, 16, '2023-11-26 15:28:33', '2023-11-26 15:28:33'),
(434, 5, 16, '2023-11-26 15:28:49', '2023-11-26 15:28:49'),
(435, 5, 15, '2023-11-26 15:40:47', '2023-11-26 15:40:47'),
(436, 5, 15, '2023-11-26 15:40:50', '2023-11-26 15:40:50'),
(437, 5, 15, '2023-11-26 15:41:08', '2023-11-26 15:41:08'),
(438, 5, 14, '2023-11-26 15:41:29', '2023-11-26 15:41:29'),
(439, NULL, 14, '2023-11-26 15:46:50', '2023-11-26 15:46:50'),
(440, NULL, 14, '2023-11-26 15:47:25', '2023-11-26 15:47:25'),
(441, NULL, 14, '2023-11-26 15:47:28', '2023-11-26 15:47:28'),
(442, NULL, 14, '2023-11-26 15:47:58', '2023-11-26 15:47:58'),
(443, NULL, 11, '2023-11-26 15:48:09', '2023-11-26 15:48:09'),
(444, NULL, 11, '2023-11-26 15:48:11', '2023-11-26 15:48:11'),
(445, NULL, 11, '2023-11-26 15:48:41', '2023-11-26 15:48:41'),
(446, NULL, 11, '2023-11-26 15:48:52', '2023-11-26 15:48:52'),
(447, NULL, 11, '2023-11-26 15:49:10', '2023-11-26 15:49:10'),
(448, NULL, 11, '2023-11-26 15:50:05', '2023-11-26 15:50:05'),
(449, NULL, 6, '2023-11-26 15:53:13', '2023-11-26 15:53:13'),
(450, 5, 7, '2023-11-26 16:05:33', '2023-11-26 16:05:33'),
(451, 5, 4, '2023-11-26 16:06:17', '2023-11-26 16:06:17'),
(452, 5, 6, '2023-11-26 16:11:00', '2023-11-26 16:11:00'),
(453, 5, 6, '2023-11-26 16:11:08', '2023-11-26 16:11:08'),
(454, 5, 6, '2023-11-26 16:11:16', '2023-11-26 16:11:16'),
(455, 5, 6, '2023-11-26 16:13:09', '2023-11-26 16:13:09'),
(456, 5, 6, '2023-11-26 16:13:18', '2023-11-26 16:13:18'),
(457, 5, 6, '2023-11-26 16:13:40', '2023-11-26 16:13:40'),
(458, 5, 6, '2023-11-26 16:14:05', '2023-11-26 16:14:05'),
(459, 5, 6, '2023-11-26 16:14:11', '2023-11-26 16:14:11'),
(460, 5, 6, '2023-11-26 16:15:18', '2023-11-26 16:15:18'),
(461, 5, 6, '2023-11-26 16:15:22', '2023-11-26 16:15:22'),
(462, 5, 6, '2023-11-26 16:15:25', '2023-11-26 16:15:25'),
(463, 5, 6, '2023-11-26 16:17:11', '2023-11-26 16:17:11'),
(464, 5, 6, '2023-11-26 16:17:42', '2023-11-26 16:17:42'),
(465, 5, 2, '2023-11-26 16:24:29', '2023-11-26 16:24:29'),
(466, 5, 2, '2023-11-26 16:24:32', '2023-11-26 16:24:32'),
(467, 5, 16, '2023-11-26 16:48:43', '2023-11-26 16:48:43'),
(468, 5, 13, '2023-11-26 16:48:53', '2023-11-26 16:48:53'),
(469, 5, 13, '2023-11-26 17:25:03', '2023-11-26 17:25:03'),
(470, 5, 3, '2023-11-26 17:31:42', '2023-11-26 17:31:42'),
(471, 5, 3, '2023-11-26 17:31:46', '2023-11-26 17:31:46'),
(472, 5, 12, '2023-11-26 20:22:51', '2023-11-26 20:22:51'),
(473, NULL, 4, '2023-11-27 09:58:07', '2023-11-27 09:58:07'),
(474, NULL, 4, '2023-11-27 09:58:10', '2023-11-27 09:58:10'),
(475, 5, 4, '2023-11-27 09:58:26', '2023-11-27 09:58:26'),
(476, 5, 5, '2023-11-27 09:58:47', '2023-11-27 09:58:47'),
(477, 5, 5, '2023-11-27 09:58:49', '2023-11-27 09:58:49'),
(478, 5, 16, '2023-11-27 10:07:24', '2023-11-27 10:07:24'),
(479, NULL, 11, '2023-12-07 09:46:38', '2023-12-07 09:46:38'),
(480, NULL, 11, '2023-12-07 09:46:42', '2023-12-07 09:46:42'),
(481, NULL, 14, '2023-12-07 09:48:20', '2023-12-07 09:48:20'),
(482, 5, 12, '2024-01-02 16:16:36', '2024-01-02 16:16:36'),
(483, 5, 12, '2024-01-02 16:19:44', '2024-01-02 16:19:44'),
(484, NULL, 12, '2024-01-02 16:35:25', '2024-01-02 16:35:25'),
(485, NULL, 16, '2024-01-02 16:49:45', '2024-01-02 16:49:45'),
(486, NULL, 4, '2024-01-02 17:00:23', '2024-01-02 17:00:23'),
(487, NULL, 4, '2024-01-02 17:00:25', '2024-01-02 17:00:25'),
(488, NULL, 4, '2024-01-02 17:01:49', '2024-01-02 17:01:49'),
(489, NULL, 4, '2024-01-02 17:02:50', '2024-01-02 17:02:50'),
(490, NULL, 4, '2024-01-02 17:04:48', '2024-01-02 17:04:48'),
(493, 5, 6, '2024-01-02 17:58:39', '2024-01-02 17:58:39'),
(494, 5, 6, '2024-01-02 17:59:39', '2024-01-02 17:59:39'),
(495, 5, 6, '2024-01-02 19:08:16', '2024-01-02 19:08:16'),
(496, 5, 16, '2024-01-02 19:18:29', '2024-01-02 19:18:29'),
(497, NULL, 16, '2024-01-02 20:00:12', '2024-01-02 20:00:12'),
(498, NULL, 9, '2024-01-03 08:07:49', '2024-01-03 08:07:49'),
(499, NULL, 9, '2024-01-03 08:07:52', '2024-01-03 08:07:52'),
(500, NULL, 9, '2024-01-03 08:14:19', '2024-01-03 08:14:19'),
(501, 5, 6, '2024-01-03 10:38:28', '2024-01-03 10:38:28'),
(502, 5, 6, '2024-01-03 10:38:31', '2024-01-03 10:38:31'),
(503, 5, 6, '2024-01-03 10:46:16', '2024-01-03 10:46:16'),
(504, 5, 6, '2024-01-03 10:46:30', '2024-01-03 10:46:30'),
(505, 5, 6, '2024-01-03 10:46:56', '2024-01-03 10:46:56'),
(506, 5, 6, '2024-01-03 10:48:58', '2024-01-03 10:48:58'),
(507, 5, 6, '2024-01-03 10:49:48', '2024-01-03 10:49:48'),
(508, 5, 6, '2024-01-03 10:56:12', '2024-01-03 10:56:12'),
(509, 5, 6, '2024-01-03 10:59:12', '2024-01-03 10:59:12'),
(510, 5, 6, '2024-01-03 11:00:16', '2024-01-03 11:00:16'),
(511, 5, 6, '2024-01-03 11:00:24', '2024-01-03 11:00:24'),
(512, 5, 6, '2024-01-03 11:00:30', '2024-01-03 11:00:30'),
(513, 5, 6, '2024-01-03 11:00:50', '2024-01-03 11:00:50'),
(514, 5, 6, '2024-01-03 11:01:10', '2024-01-03 11:01:10'),
(515, 5, 6, '2024-01-03 11:02:36', '2024-01-03 11:02:36'),
(516, 5, 6, '2024-01-03 11:02:52', '2024-01-03 11:02:52'),
(517, 5, 6, '2024-01-03 11:03:07', '2024-01-03 11:03:07'),
(518, 5, 6, '2024-01-03 11:03:25', '2024-01-03 11:03:25'),
(519, 5, 6, '2024-01-03 11:07:10', '2024-01-03 11:07:10'),
(520, 5, 16, '2024-01-04 10:49:02', '2024-01-04 10:49:02'),
(521, 5, 16, '2024-01-04 10:49:54', '2024-01-04 10:49:54'),
(522, 5, 16, '2024-01-04 10:50:04', '2024-01-04 10:50:04'),
(523, 5, 4, '2024-01-04 11:02:09', '2024-01-04 11:02:09'),
(524, 5, 15, '2024-01-04 11:04:19', '2024-01-04 11:04:19'),
(525, NULL, 12, '2024-01-07 07:13:19', '2024-01-07 07:13:19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `avatar_public_id` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `google_id` varchar(50) DEFAULT NULL,
  `status` enum('registered','verified','blocked') NOT NULL DEFAULT 'registered',
  `verification_token` varchar(100) DEFAULT NULL,
  `last_email_sent_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `full_name`, `avatar`, `avatar_public_id`, `email`, `username`, `password`, `role`, `google_id`, `status`, `verification_token`, `last_email_sent_at`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Admin', 'https://res.cloudinary.com/tudvh/image/upload/v1698740308/trick-lor/user-avatar/1.jpg', 'trick-lor/user-avatar/1', NULL, 'admin', '$2y$10$n0Ups9gJr85xJQej3O0yv./G4ruafpI5Yd9jkgA2SknEGBvC3QKuW', 'admin', NULL, 'verified', NULL, NULL, '2023-09-22 03:33:01', '2023-10-31 15:18:28'),
(2, 'Đặng Văn Hoài Tú', NULL, NULL, NULL, 'tudvh', '$2y$10$ogYedV2pQzDlx9vmD7eBqeVy6pgykXZjL5djXBjfBcnpdaAMhzDTK', 'admin', NULL, 'verified', NULL, NULL, '2023-10-05 10:29:40', '2023-10-05 10:29:40'),
(3, 'Nguyễn Đắc Toàn', NULL, NULL, NULL, 'toannd', '$2y$10$ogYedV2pQzDlx9vmD7eBqeVy6pgykXZjL5djXBjfBcnpdaAMhzDTK', 'admin', NULL, 'verified', NULL, NULL, '2023-10-05 10:31:45', '2023-10-05 10:31:45'),
(4, 'Nguyễn User', NULL, NULL, 'user@gmail.com', NULL, '$2y$10$vwikvnz4S4282g0Ap5Y8FuASh4vFuIyHUw72o7VO.ybnS6cFXhuw2', 'user', NULL, 'verified', NULL, NULL, '2023-10-06 19:27:39', '2023-10-08 22:13:50'),
(5, 'Đặng Văn Hoài Tú', 'https://res.cloudinary.com/tudvh/image/upload/v1704260764/trick-lor/user-avatar/5.png', 'trick-lor/user-avatar/5', 'tudang9520@gmail.com', NULL, '$2y$10$xyMU2Eb/nL.J4qHz4iD5puWHlPUcad9KiqOcz7g3rVmIxbRRA3Z4i', 'user', '114947229524934029235', 'verified', NULL, '2024-01-07 17:04:38', '2023-10-13 09:53:21', '2024-01-07 17:04:38');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Chỉ mục cho bảng `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`post_id`,`category_id`),
  ADD KEY `category_id` (`category_id`) USING BTREE;

--
-- Chỉ mục cho bảng `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `reply_id` (`reply_id`);

--
-- Chỉ mục cho bảng `post_saves`
--
ALTER TABLE `post_saves`
  ADD PRIMARY KEY (`user_id`,`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Chỉ mục cho bảng `post_views`
--
ALTER TABLE `post_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `post_views`
--
ALTER TABLE `post_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=526;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `post_categories`
--
ALTER TABLE `post_categories`
  ADD CONSTRAINT `post_categories_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `post_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `post_comments`
--
ALTER TABLE `post_comments`
  ADD CONSTRAINT `post_comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_comments_ibfk_3` FOREIGN KEY (`reply_id`) REFERENCES `post_comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `post_saves`
--
ALTER TABLE `post_saves`
  ADD CONSTRAINT `post_saves_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_saves_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `post_views`
--
ALTER TABLE `post_views`
  ADD CONSTRAINT `post_views_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_views_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;