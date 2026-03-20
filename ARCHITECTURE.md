# Architecture: lex

## Purpose
Lex (pyrocms/lex) — a lightweight PHP template parser used by PyroCMS. Parses a custom `{{ variable }}` and `{{ tag:method }}` template syntax, supporting conditionals, loops, and plugin callbacks.

## Directory Structure
```
lib/Lex/
  Parser.php               # Main template parser — parse(), parseVariables(), parseTags()
  Parsing_Exception.php    # Exception for syntax and runtime parse errors
  Arrayable_Interface.php  # Interface for objects that can be converted to arrays for the parser
  Arrayable_Object_Example.php  # Example implementation of Arrayable_Interface
tests/
vendor/                    # Dev dependencies only (PHPUnit)
```

## Key Design Decisions
- **Simple tag syntax** — templates use `{{ variable }}`, `{{ tag:method }}`, `{{ if condition }}...{{ endif }}`, `{{ foreach items }}...{{ endforeach }}`. No compilation step; parsing is done at runtime.
- **Callback-based tag resolution** — the parser calls a user-provided callback when it encounters a `{{ tag:method }}` call, allowing any PHP callable to serve as a plugin/tag handler.
- **`Arrayable_Interface`** — objects implement `toArray()` to expose their data to the template engine, avoiding tight coupling between domain objects and the parser's array-based data model.
- **Recursive parsing** — nested tags and variable interpolation inside tag attribute values are handled by recursive parse calls.

## Extension Points
- Pass a callback to `Parser::parse()` to handle `{{ tag:method }}` calls with custom plugin logic.
- Implement `Arrayable_Interface` on domain objects to make them directly usable as template data.

## Dependency Flow
```
Parser::parse($template, $data, $callback)
  ├─ parseVariables($template, $data) → replaces {{ var }} with values
  ├─ parseConditionals($template, $data) → evaluates {{ if }}...{{ endif }}
  ├─ parseLoops($template, $data) → expands {{ foreach }}...{{ endforeach }}
  └─ parseTags($template, $callback) → calls $callback('tag', 'method', $attributes) → string
```
